package main

import (
	"bytes"
	"encoding/binary"
	"fmt"
	"net"
)

type Telemetry struct {
	IsRaceOn    int32
	TimestampMS uint32

	EngineMaxRpm     float32
	EngineIdleRpm    float32
	CurrentEngineRpm float32

	AccelerationY float32
	AccelerationX float32
	AccelerationZ float32

	VelocityX float32
	VelocityY float32
	VelocityZ float32

	AngularVelocityX float32
	AngularVelocityY float32
	AngularVelocityZ float32

	Yaw   float32
	Pitch float32
	Roll  float32

	NormalizedSuspensionTravelFrontLeft  float32
	NormalizedSuspensionTravelFrontRight float32
	NormalizedSuspensionTravelRearLeft   float32
	NormalizedSuspensionTravelRearRight  float32

	TireSlipRatioFrontLeft  float32
	TireSlipRatioFrontRight float32
	TireSlipRatioRearLeft   float32
	TireSlipRatioRearRight  float32

	WheelRotationSpeedFrontLeft  float32
	WheelRotationSpeedFrontRight float32
	WheelRotationSpeedRearLeft   float32
	WheelRotationSpeedRearRight  float32

	WheelOnRumbleStripFrontLeft  int32
	WheelOnRumbleStripFrontRight int32
	WheelOnRumbleStripRearLeft   int32
	WheelOnRumbleStripRearRight  int32

	WheelInPuddleDepthFrontLeft  float32
	WheelInPuddleDepthFrontRight float32
	WheelInPuddleDepthRearLeft   float32
	WheelInPuddleDepthRearRight  float32

	SurfaceRumbleFrontLeft  float32
	SurfaceRumbleFrontRight float32
	SurfaceRumbleRearLeft   float32
	SurfaceRumbleRearRight  float32

	TireSlipAngleFrontLeft  float32
	TireSlipAngleFrontRight float32
	TireSlipAngleRearLeft   float32
	TireSlipAngleRearRight  float32

	TireCombinedSlipFrontLeft  float32
	TireCombinedSlipFrontRight float32
	TireCombinedSlipRearLeft   float32
	TireCombinedSlipRearRight  float32

	SuspensionTravelMetersFrontLeft  float32
	SuspensionTravelMetersFrontRight float32
	SuspensionTravelMetersRearLeft   float32
	SuspensionTravelMetersRearRight  float32

	CarOrdinal          int32
	CarClass            int32
	CarPerformanceIndex int32
	DrivetrainType      int32
	NumCylinders        int32

	HorizonPlaceholder1 int32
	HorizonPlaceholder2 int32
	HorizonPlaceholder3 int32

	PositionX float32
	PositionY float32
	PositionZ float32

	Speed  float32
	Power  float32
	Torque float32

	TireTempFrontLeft  float32
	TireTempFrontRight float32
	TireTempRearLeft   float32
	TireTempRearRight  float32

	Boost float32
	Fuel  float32

	DistanceTraveled float32
	BestLap          float32
	LastLap          float32
	CurrentLap       float32
	CurrentRaceTime  float32
	LapNumber        uint16
	RacePosition     uint8

	Accel     uint8
	Brake     uint8
	Clutch    uint8
	HandBrake uint8
	Gear      uint8
	Steer     int8

	NormalizedDrivingLine       int8
	NormalizedAIBrakeDifference int8
}

func main() {
	addr, err := net.ResolveUDPAddr("udp", ":9090")
	if err != nil {
		panic(err)
	}

	conn, err := net.ListenUDP("udp", addr)
	if err != nil {
		panic(err)
	}
	defer conn.Close()

	fmt.Println("UDP listener running on port 9090")

	buf := make([]byte, 2048)

	for {
		n, _, err := conn.ReadFromUDP(buf)
		if err != nil {
			fmt.Println("Error reading:", err)
			continue
		}

		var data Telemetry
		err = binary.Read(bytes.NewReader(buf[:n]), binary.LittleEndian, &data)
		if err != nil {
			fmt.Println("Binary decode error:", err)
			continue
		}

		fmt.Printf("Speed: %.2f m/s, RPM: %.0f\n", data.Speed, data.CurrentEngineRpm)
	}
}
