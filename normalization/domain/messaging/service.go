package messaging

import (
	"fmt"

	"github.com/IBM/sarama"
	"google.golang.org/protobuf/proto"
)

type Kafka struct {
	producer sarama.AsyncProducer
}

func MakeKafka() Kafka {
	config := sarama.NewConfig()
	config.Producer.Return.Successes = true
	producer, err := sarama.NewAsyncProducer([]string{"kafka:9092"}, config)
	if err != nil {
		panic("Failed to create producer: " + err.Error())
	}
	return Kafka{
		producer: producer,
	}
}

func (kafka *Kafka) CloseKafka() {
	kafka.producer.Close()
}

func (kafka *Kafka) Post(data *TelemetryData) {
	protoData, err := proto.Marshal(data)
	if err != nil {
		fmt.Println("Failed to marshal proto: " + err.Error())
		return
	}
	message := &sarama.ProducerMessage{Topic: "telemetry", Value: sarama.ByteEncoder(protoData)}

	kafka.producer.Input() <- message
}
