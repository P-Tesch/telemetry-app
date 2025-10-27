package messaging

import (
	"github.com/IBM/sarama"
	"github.com/gogo/protobuf/proto"
)

func Post(data TelemetryData) {
	config := sarama.NewConfig()
	config.Producer.Return.Successes = true
	producer, err := sarama.NewAsyncProducer([]string{"kafka:9092"}, config)
	if err != nil {
		panic(err)
	}

	protoData, err := proto.Marshal(data) // TODO: Proto object
	message := &sarama.ProducerMessage{Topic: "my_topic", Value: sarama.ByteEncoder(protoData)}

	producer.Input() <- message
}
