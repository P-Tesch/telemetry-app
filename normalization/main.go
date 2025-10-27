package main

import (
	"github.com/P-Tesch/telemetry-app/normalization/routes"
)

func main() {
	routes.RegisterUDPRoutes()

	select {}
}
