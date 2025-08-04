<?php

declare(strict_types=1);
namespace OCA\JwtAuth\Settings;

use OCP\Settings\DeclarativeSettingsTypes;
use OCP\Settings\IDeclarativeSettingsForm;

class DeclarativeSettingsForm implements IDeclarativeSettingsForm {
	public function getSchema(): array {
		return [
			'id' => 'jwtauth',
			'priority' => 10,
			'section_type' => DeclarativeSettingsTypes::SECTION_TYPE_ADMIN, // admin, personal
			'section_id' => 'jwtauth',
			'storage_type' => DeclarativeSettingsTypes::STORAGE_TYPE_INTERNAL, // external, internal (handled by core to store in appconfig and preferences)
			'title' => 'Jwt Auth Settings', // NcSettingsSection name
			'description' => 'This form is registered with a DeclarativeSettingsForm class', // NcSettingsSection description
			'doc_url' => '', // NcSettingsSection doc_url for documentation or help page, empty string if not needed
			'fields' => [
				[
					'id' => 'SharedSecret', // configkey
					'title' => 'JWT Shared Secret', // label
					'description' => 'Set some simple text setting', // hint
					'type' => DeclarativeSettingsTypes::PASSWORD, // text, password, email, tel, url, number
					'placeholder' => 'Shared Secret', // placeholder
					'default' => '',
					'sensitive' => true,
				],
				[
					'id' => 'AutoLoginTriggerUri', // configkey
					'title' => 'Auto Login Trigger URI', // label
					'description' => 'Set some simple text setting', // hint
					'type' => DeclarativeSettingsTypes::TEXT, // text, password, email, tel, url, number
					'placeholder' => 'Auto Login Trigger URI', // placeholder
				],
				[
					'id' => 'LogoutConfirmationUri', // configkey
					'title' => 'Logout Confirmation URI', // label
					'description' => 'Set some simple text setting', // hint
					'type' => DeclarativeSettingsTypes::TEXT, // text, password, email, tel, url, number
					'placeholder' => 'Logout Confirmation URI', // placeholder
				],
			],
		];
	}
}
