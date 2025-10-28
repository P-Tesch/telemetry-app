package fh4

import (
	"bytes"
	"encoding/binary"
	"fmt"
	"net"

	"github.com/P-Tesch/telemetry-app/normalization/domain/messaging"
)

func Listen(portStart int, portEnd int) {
	kafka := messaging.MakeKafka()
	defer kafka.CloseKafka()

	for port := portStart; port <= portEnd; port++ {
		go listenPort(port, &kafka)
	}
	fmt.Printf("UDP listener running on port range %d-%d", portStart, portEnd)
}

func listenPort(port int, kafka *messaging.Kafka) {
	addr, err := net.ResolveUDPAddr("udp", ":"+fmt.Sprint(port))
	if err != nil {
		panic("Failed resolving address: " + err.Error())
	}

	conn, err := net.ListenUDP("udp", addr)
	if err != nil {
		panic("Failed listening to port: " + err.Error())
	}
	defer conn.Close()

	buf := make([]byte, 1024)

	for {
		n, _, err := conn.ReadFromUDP(buf)
		if err != nil {
			fmt.Println("Error reading:", err)
			continue
		}

		var data FH4TelemetryData
		err = binary.Read(bytes.NewReader(buf[:n]), binary.LittleEndian, &data)
		if err != nil {
			fmt.Println("Binary decode error:", err)
			continue
		}

		kafka.Post(data.Convert())
	}
}
