<?php
namespace OCA\JwtAuth\Controller;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\RedirectResponse;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\Attribute\AuthorizedAdminSetting;


class JwtAuthSettingsController extends Controller {
    /**
     * Save settings
     */
    #[PasswordConfirmationRequired]
    #[AuthorizedAdminSetting(settings: 'OCA\JwtAuth\Settings\JwtAuthAdmin')]
    public function saveSettings($mySetting) {
        
    }
    
}
