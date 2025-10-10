package routes

import (
	"github.com/P-Tesch/telemetry-app/normalization/domain/listeners/fh4"
)

func RegisterUDPRoutes() {
	fh4.Listen()
}
