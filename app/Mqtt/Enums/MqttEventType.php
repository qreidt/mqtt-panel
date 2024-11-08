<?php

namespace App\Mqtt\Enums;

enum MqttEventType: string
{
    case MqttPacketProcessed = "MqttPacketProcessed";
    case MqttClientConnected = "MqttClientConnected";
    case MqttClientDisconnected = "MqttClientDisconnected";
    case MqttClientSubscribed = "MqttClientSubscribed";
    case MqttClientUnsubscribed = "MqttClientUnsubscribed";
    case MqttClientPublished = "MqttClientPublished";
}
