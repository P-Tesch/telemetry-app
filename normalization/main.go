package main

import (
	"net/http"

	"github.com/P-Tesch/telemetry-app/normalization/routes"
)

func main() {
	routes.RegisterUDPRoutes()

	http.ListenAndServe(":8888", nil)
}
