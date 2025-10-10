package fh4

import (
	"net"

	"github.com/P-Tesch/telemetry-app/normalization/utils"
)

func Listen() {
	conn, err := net.ListenPacket("udp", ":1000")
	utils.HandleError(err)

	print(conn)
}
