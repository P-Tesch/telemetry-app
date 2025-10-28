package fh4

import "github.com/P-Tesch/telemetry-app/normalization/domain/messaging"

func (fh4data FH4TelemetryData) Convert() *messaging.TelemetryData {
	return &messaging.TelemetryData{
		IsRaceOn:  fh4data.IsRaceOn,
		Timestamp: fh4data.TimestampMS,
		Rpm:       fh4data.Rpm.convert(),
		CarInfo:   fh4data.CarInfo.convert(),
		Position:  fh4data.Position.convert(),
		Rotation:  fh4data.Rotation.convert(),
		Speed:     fh4data.Speed,
		Power:     fh4data.Power,
		Torque:    fh4data.Torque,
		Boost:     fh4data.Boost,
		Fuel:      fh4data.Fuel,
		TireTemp:  fh4data.TireTemp.convert(),
		RaceInfo:  fh4data.RaceInfo.convert(),
		Controls:  fh4data.Controls.convert(),
	}
}

func (rpm Rpm) convert() *messaging.Rpm {
	return &messaging.Rpm{
		Max:     rpm.Max,
		Current: rpm.Current,
	}
}

func (rotation Rotation) convert() *messaging.Vector {
	return &messaging.Vector{
		X: rotation.Pitch,
		Y: rotation.Roll,
		Z: rotation.Yaw,
	}
}

func (carInfo CarInfo) convert() *messaging.CarInfo {
	return &messaging.CarInfo{
		Ordinal:          carInfo.Ordinal,
		Class:            carInfo.Class,
		PerformanceIndex: carInfo.PerformanceIndex,
		DrivetrainType:   carInfo.DrivetrainType,
		NumCylinders:     carInfo.NumCylinders,
	}
}

func (vector Vector) convert() *messaging.Vector {
	return &messaging.Vector{
		X: vector.X,
		Y: vector.Y,
		Z: vector.Z,
	}
}

func (wheelsData WheelsData) convert() *messaging.WheelsData {
	return &messaging.WheelsData{
		FL: wheelsData.FL,
		FR: wheelsData.FR,
		RL: wheelsData.RL,
		RR: wheelsData.RR,
	}
}

func (raceInfo RaceInfo) convert() *messaging.RaceInfo {
	return &messaging.RaceInfo{
		BestLap:         raceInfo.BestLap,
		LastLap:         raceInfo.LastLap,
		CurrentLap:      raceInfo.CurrentLap,
		CurrentRaceTime: raceInfo.CurrentRaceTime,
		LapNumber:       uint32(raceInfo.LapNumber),
		RacePosition:    uint32(raceInfo.RacePosition),
	}
}

func (controls Controls) convert() *messaging.Controls {
	return &messaging.Controls{
		Accel:     uint32(controls.Accel),
		Brake:     uint32(controls.Brake),
		Clutch:    uint32(controls.Clutch),
		Handbrake: uint32(controls.HandBrake),
		Gear:      uint32(controls.Gear),
		Steer:     uint32(controls.Steer),
	}
}
