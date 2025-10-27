package fh4

import (
	"bytes"
	"encoding/binary"
	"fmt"
	"net"

	"github.com/P-Tesch/telemetry-app/normalization/utils"
)

func Listen(portStart int, portEnd int) {
	for port := portStart; port <= portEnd; port++ {
		go listenPort(port)
	}
	fmt.Printf("UDP listener running on port range %d-%d", portStart, portEnd)
}

func listenPort(port int) {
	addr, err := net.ResolveUDPAddr("udp", ":"+fmt.Sprint(port))
	utils.HandleError(err)

	conn, err := net.ListenUDP("udp", addr)
	utils.HandleError(err)
	defer conn.Close()

	buf := make([]byte, 2048)

	for {
		n, _, err := conn.ReadFromUDP(buf)
		if err != nil {
			fmt.Println("Error reading:", err)
			continue
		}

		var data TelemetryData
		err = binary.Read(bytes.NewReader(buf[:n]), binary.LittleEndian, &data)
		if err != nil {
			fmt.Println("Binary decode error:", err)
			continue
		}

		fmt.Printf("Speed: %.2f m/s, RPM: %.0f\n", data.Speed, data.Rpm.Current)
	}
}
