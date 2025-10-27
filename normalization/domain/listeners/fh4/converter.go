package fh4

import "github.com/P-Tesch/telemetry-app/normalization/domain/messaging"

func (fh4data FH4TelemetryData) Convert() messaging.TelemetryData {
	return messaging.TelemetryData{
		IsRaceOn:  fh4data.IsRaceOn,
		Timestamp: fh4data.TimestampMS,
		Rpm:       fh4data.Rpm.convert(),
		CarInfo:   messaging.CarInfo(fh4data.CarInfo),
		Position:  messaging.Vector(fh4data.Position),
		Rotation:  fh4data.Rotation.convert(),
		Speed:     fh4data.Speed,
		Power:     fh4data.Power,
		Torque:    fh4data.Torque,
		Boost:     fh4data.Boost,
		Fuel:      fh4data.Fuel,
		TireTemp:  messaging.WheelsData(fh4data.TireTemp),
		RaceInfo:  messaging.RaceInfo(fh4data.RaceInfo),
		Controls:  messaging.Controls(fh4data.Controls),
	}
}

func (rotation Rotation) convert() messaging.Vector {
	return messaging.Vector{
		X: rotation.Pitch,
		Y: rotation.Roll,
		Z: rotation.Yaw,
	}
}

func (rpm Rpm) convert() messaging.Rpm {
	return messaging.Rpm{
		Max:     rpm.Max,
		Current: rpm.Current,
	}
}
