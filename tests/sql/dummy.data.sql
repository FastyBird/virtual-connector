INSERT
IGNORE INTO `fb_devices_module_connectors` (`connector_id`, `connector_identifier`, `connector_name`, `connector_comment`, `connector_enabled`, `connector_type`, `created_at`, `updated_at`) VALUES
(_binary 0x93e760e1f0114a33a70dc9629706ccf8, 'virtual', 'Virtual', null, true, 'virtual', '2023-10-15 11:00:00', '2023-10-15 11:00:00'),
(_binary 0xbda37bc79bd74083a925386ac5522325, 'universal-test-connector', 'Testing connector', null, true, 'dummy', '2023-10-15 11:00:00', '2023-10-15 11:00:00');

INSERT
IGNORE INTO `fb_devices_module_connectors_controls` (`control_id`, `connector_id`, `control_name`, `created_at`, `updated_at`) VALUES
(_binary 0xe7c9e5834af14b86b647f179207e6456, _binary 0x93e760e1f0114a33a70dc9629706ccf8, 'reboot', '2023-10-15 11:00:00', '2023-10-15 11:00:00');

INSERT
IGNORE INTO `fb_devices_module_devices` (`device_id`, `connector_id`, `device_category`, `device_identifier`, `device_name`, `device_comment`, `params`, `created_at`, `updated_at`, `owner`, `device_type`) VALUES
(_binary 0x552cea8a0e8141d9be2f839b079f315e, _binary 0x93e760e1f0114a33a70dc9629706ccf8, 'generic', 'thermostat-office', 'Thermostat - Office', null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', null, 'virtual-thermostat'),
(_binary 0x495a7b6804284bdcb098dca416f03363, _binary 0xbda37bc79bd74083a925386ac5522325, 'generic', 'universal-test-device', 'Actor & Sensor device', null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', null, 'dummy');

INSERT
IGNORE INTO `fb_devices_module_devices_properties` (`property_id`, `device_id`, `parent_id`, `property_category`, `property_identifier`, `property_name`, `property_settable`, `property_queryable`, `property_data_type`, `property_unit`, `property_format`, `property_invalid`, `property_scale`, `property_step`, `property_value`, `property_default`, `params`, `created_at`, `updated_at`, `property_type`) VALUES
(_binary 0x580a6d7c45174821a6562810ae876898, _binary 0x552cea8a0e8141d9be2f839b079f315e, null, 'generic', 'hardware_model', null, 0, 0, 'string', null, null, null, null, null, 'virtual-thermostat', null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'variable'),
(_binary 0xc24e65c8610a437db7097de3127695e3, _binary 0x552cea8a0e8141d9be2f839b079f315e, null, 'generic', 'state', null, 0, 0, 'enum', null, 'connected,disconnected,alert,unknown', null, null, null, null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'dynamic'),
(_binary 0x4412b0eaafba41c3a9d07d3b04abf61c, _binary 0x552cea8a0e8141d9be2f839b079f315e, null, 'generic', 'hardware_mac_address', null, 0, 0, 'string', null, null, null, null, null, '9f:c7:60:c3:c8:bd:64', null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'variable'),
(_binary 0xdb3dc98d0ea744ad8be3397dd48f62b4, _binary 0x552cea8a0e8141d9be2f839b079f315e, null, 'generic', 'hardware_manufacturer', null, 0, 0, 'string', null, null, null, null, null, 'FastyBird', null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'variable');

INSERT
IGNORE INTO `fb_devices_module_channels` (`channel_id`, `device_id`, `channel_category`, `channel_identifier`, `channel_name`, `channel_comment`, `params`, `created_at`, `updated_at`, `channel_type`) VALUES
(_binary 0xc2c572b3324844daaca0fd329e1d9418, _binary 0x552cea8a0e8141d9be2f839b079f315e, 'generic', 'thermostat', null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'virtual-thermostat'),
(_binary 0x29e4d707142d422499830e568f259639, _binary 0x552cea8a0e8141d9be2f839b079f315e, 'generic', 'sensors', null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'virtual-sensors'),
(_binary 0x9808b3869ed44e5888f1b39f5f70ef39, _binary 0x552cea8a0e8141d9be2f839b079f315e, 'generic', 'actors', null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'virtual-actors'),
(_binary 0xc55dcc2f43c84f03862ea5a2c5ba91c4, _binary 0x552cea8a0e8141d9be2f839b079f315e, 'generic', 'preset_away', null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'virtual-preset'),
(_binary 0xe1cb79d9f61840ac9576258a501a98be, _binary 0x552cea8a0e8141d9be2f839b079f315e, 'generic', 'preset_eco', null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'virtual-preset'),
(_binary 0x9791d405104c449583a1ffca996924ba, _binary 0x552cea8a0e8141d9be2f839b079f315e, 'generic', 'preset_home', null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'virtual-preset'),
(_binary 0x6ecec6b9a48a48918d61d552e63e5f5a, _binary 0x495a7b6804284bdcb098dca416f03363, 'generic', 'thermometer', 'Heating element', null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'channel');

INSERT
IGNORE INTO `fb_devices_module_channels_properties` (`property_id`, `channel_id`, `parent_id`, `property_category`, `property_identifier`, `property_name`, `property_settable`, `property_queryable`, `property_data_type`, `property_unit`, `property_format`, `property_invalid`, `property_scale`, `property_step`, `property_value`, `property_default`, `params`, `created_at`, `updated_at`, `property_type`) VALUES
(_binary 0x9c5e5a5f1b5d4394a9b9199f1701efac, _binary 0x6ecec6b9a48a48918d61d552e63e5f5a, null, 'generic', 'sensor', 'Temperature', 0, 1, 'float', '°C', null, null, null, null, null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'dynamic'),
(_binary 0x1e196c5ca4694ec795e7c4bb48d58fe0, _binary 0x6ecec6b9a48a48918d61d552e63e5f5a, null, 'generic', 'floor_sensor', 'Floor temperature', 0, 1, 'float', '°C', null, null, null, null, null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'dynamic'),
(_binary 0x11807caa082c468b8a1b88ba8a715ca1, _binary 0x6ecec6b9a48a48918d61d552e63e5f5a, null, 'generic', 'actor', 'Switch', 1, 1, 'bool', null, null, null, null, null, null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'dynamic'),
(_binary 0x1e196c5ca4694ec795e7c4bb48d58fe0, _binary 0xc55dcc2f43c84f03862ea5a2c5ba91c4, null, 'generic', 'target_temperature', null, 1, 1, 'float', null, '7:35', null, null, 0.1, null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'dynamic'),
(_binary 0x767ddcf624c548b0baaae8c7a90d3dc0, _binary 0xe1cb79d9f61840ac9576258a501a98be, null, 'generic', 'target_temperature', null, 1, 1, 'float', null, '7:35', null, null, 0.1, null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'dynamic'),
(_binary 0xf0b8100f5ddb4abd8015d0dbf9a11aa0, _binary 0xc2c572b3324844daaca0fd329e1d9418, null, 'generic', 'preset_mode', null, 0, 1, 'enum', null, 'manual,away,eco,home', null, null, null, null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'dynamic'),
(_binary 0xa74d06a48eb2440e8bb06ec54a0bf93c, _binary 0xc2c572b3324844daaca0fd329e1d9418, null, 'generic', 'actual_temperature', null, 0, 1, 'float', null, '7:35', null, null, 0.1, null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'dynamic'),
(_binary 0x17627f14ebbf4bc188fde8fc32d3e5de, _binary 0xc2c572b3324844daaca0fd329e1d9418, null, 'generic', 'target_temperature', null, 1, 1, 'float', null, '7:35', null, null, 0.1, null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'dynamic'),
(_binary 0xa326ba38d1884eaca6ad43bdcc84a730, _binary 0xc2c572b3324844daaca0fd329e1d9418, null, 'generic', 'hvac_mode', null, 1, 1, 'enum', null, 'off,heat', null, null, null, null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'dynamic'),
(_binary 0xc07dbed51a6d4a9cbdc831fe5b77cccd, _binary 0xc2c572b3324844daaca0fd329e1d9418, null, 'generic', 'high_target_temperature_tolerance', null, 0, 0, 'float', null, null, null, null, 0.1, '0.3', null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'variable'),
(_binary 0x04cd4f8fe8a640a3b2ef33f574988ee8, _binary 0xc2c572b3324844daaca0fd329e1d9418, null, 'generic', 'hvac_state', null, 0, 1, 'enum', null, 'off,inactive,heating', null, null, null, null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'dynamic'),
(_binary 0xb814bc0c9ce54f2d82ccf21e6b0e20f0, _binary 0xc2c572b3324844daaca0fd329e1d9418, null, 'generic', 'low_target_temperature_tolerance', null, 0, 0, 'float', null, null, null, null, 0.1, '0.3', null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'variable'),
(_binary 0xd58fe8940d1c4bf0bff5a190cab20e5c, _binary 0x29e4d707142d422499830e568f259639, _binary 0x9c5e5a5f1b5d4394a9b9199f1701efac, 'generic', 'target_sensor_1', null, 0, 1, 'float', null, null, null, null, null, null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'mapped'),
(_binary 0xe2b982612a05483dbe7cac3afe3888b2, _binary 0x29e4d707142d422499830e568f259639, _binary 0x1e196c5ca4694ec795e7c4bb48d58fe0, 'generic', 'floor_sensor_1', null, 0, 1, 'float', null, null, null, null, null, null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'mapped'),
(_binary 0xbceca5432de744b18a3387e9574b6731, _binary 0x9808b3869ed44e5888f1b39f5f70ef39, _binary 0x11807caa082c468b8a1b88ba8a715ca1, 'generic', 'heater_1', null, 1, 1, 'bool', null, null, null, null, null, null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'mapped'),
(_binary 0x15d157d10ec742a7968351678de1ce9a, _binary 0x9791d405104c449583a1ffca996924ba, null, 'generic', 'target_temperature', null, 1, 1, 'float', null, '7:35', null, null, 0.1, null, null, null, '2023-10-15 11:00:00', '2023-10-15 11:00:00', 'dynamic');
