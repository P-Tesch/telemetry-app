package messaging

type Vector struct {
	X float32
	Y float32
	Z float32
}

type WheelsData struct {
	FL float32
	FR float32
	RL float32
	RR float32
}

type CarInfo struct {
	Ordinal          int32
	Class            int32
	PerformanceIndex int32
	DrivetrainType   int32
	NumCylinders     int32
}

type RaceInfo struct {
	DistanceTraveled float32
	BestLap          float32
	LastLap          float32
	CurrentLap       float32
	CurrentRaceTime  float32
	LapNumber        uint16
	RacePosition     uint8
}

type Rpm struct {
	Max     float32
	Current float32
}

type Controls struct {
	Accel     uint8
	Brake     uint8
	Clutch    uint8
	HandBrake uint8
	Gear      uint8
	Steer     int8
}

type TelemetryData struct {
	IsRaceOn  int32
	Timestamp uint32

	Rpm Rpm

	CarInfo CarInfo

	Position Vector
	Rotation Vector

	Speed  float32
	Power  float32
	Torque float32
	Boost  float32
	Fuel   float32

	TireTemp WheelsData

	RaceInfo RaceInfo

	Controls Controls
}
