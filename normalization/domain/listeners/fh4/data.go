package fh4

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

type WheelsDataInt struct {
	FL int32
	FR int32
	RL int32
	RR int32
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

type HorizonPlaceholder struct {
	Hzn1 int32
	Hzn2 int32
	Hzn3 int32
}

type Rpm struct {
	Max     float32
	Idle    float32
	Current float32
}

type Rotation struct {
	Yaw   float32
	Pitch float32
	Row   float32
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
	IsRaceOn    int32
	TimestampMS uint32

	Rpm Rpm

	Acceleration    Vector
	Velocity        Vector
	AngularVelocity Vector

	Rotation Rotation

	NormalizedSuspension   WheelsData
	TireSlipRatio          WheelsData
	WheelRotationSpeed     WheelsData
	WheelOnRumbleStrip     WheelsDataInt
	WheelInPuddleDepth     WheelsData
	SurfaceRumble          WheelsData
	TireSlipAngle          WheelsData
	TireCombinedSlip       WheelsData
	SuspensionTravelMeters WheelsData

	CarInfo CarInfo

	HorizonPlaceholder HorizonPlaceholder

	Position Vector

	Speed  float32
	Power  float32
	Torque float32

	TireTemp WheelsData

	Boost float32
	Fuel  float32

	RaceInfo RaceInfo

	Controls Controls

	NormalizedDrivingLine       int8
	NormalizedAIBrakeDifference int8
}
