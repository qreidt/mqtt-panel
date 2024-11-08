<?php

namespace App\Mqtt\Enums;

enum MqttEvent: string
{
    case MqttPacketProcessed = "MqttPacketProcessed";
    case MqttClientConnected = "MqttClientConnected";
    case MqttClientDisconnected = "MqttClientDisconnected";
    case MqttClientSubscribed = "MqttClientSubscribed";
    case MqttClientUnsubscribed = "MqttClientUnsubscribed";
    case MqttClientPublished = "MqttClientPublished";
}
