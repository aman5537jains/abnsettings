<?php

use Aman5537jains\AbnCmsSettingPlugin\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("CREATE TABLE `settings` (
              `id` int(10) UNSIGNED NOT NULL,
              `name` varchar(191) NOT NULL,
              `slug` varchar(191) NOT NULL,
              `description` text DEFAULT NULL,
              `parameter_type` enum('color','string','email','number','url','boolean','phone_number','file','happyhours','editor','image','password') NOT NULL DEFAULT 'string',
              `status` tinyint(1) NOT NULL DEFAULT 1,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

        \DB::statement("INSERT INTO `settings` (`id`, `name`, `slug`, `description`, `parameter_type`, `status`, `created_at`, `updated_at`) VALUES
        (1, 'PROJECT_NAME', 'project-name', 'Abn Cms', 'string', 1, '2017-12-08 17:00:00', '2024-05-09 00:15:47'),
        (2, 'MAIL_HOST', 'MAIL_HOST', 'outlook.office365.com', 'string', 1, NULL, '2023-01-10 00:56:39'),
        (3, 'MAIL_PORT', 'MAIL_PORT', '587', 'number', 1, NULL, NULL),
        (4, 'MAIL_USERNAME', 'MAIL_USERNAME', 'info@delytt.com', 'string', 1, NULL, '2023-01-09 22:07:04'),
        (5, 'MAIL_PASSWORD', 'MAIL_PASSWORD', 'Delytt@2022', 'password', 1, NULL, '2023-01-09 22:07:20'),
        (6, 'MAIL_ENCRYPTION', 'MAIL_ENCRYPTION', 'tls', 'string', 1, NULL, NULL),
        (7, 'MAIL_FROM_NAME', 'MAIL_FROM_NAME', 'Gretsa', 'string', 1, '2019-06-19 20:30:00', '2023-01-09 22:08:25'),
        (10, 'SOCIAL_FACEBOOK_URL', 'SOCIAL_FACEBOOK_URL', 'https://www.facebook.com/Gretsa', 'url', 1, '2023-11-02 08:21:53', '2023-11-02 08:21:53'),
        (11, 'SOCIAL_TWITTER_URL', 'SOCIAL_TWITTER_URL', 'https://twitter.com/', 'url', 1, '2023-11-02 08:21:53', '2023-11-02 08:21:53'),
        (12, 'SOCIAL_LINKEDIN_URL', 'SOCIAL_LINKEDIN_URL', 'https://www.linkedin.com/', 'url', 1, '2023-11-02 08:21:53', '2023-11-02 08:21:53'),
        (13, 'SOCIAL_INSTAGRAM_URL', 'SOCIAL_INSTAGRAM_URL', 'https://www.instagram.com/', 'url', 1, '2023-11-02 08:21:53', '2023-11-02 08:21:53'),
        (14, 'SOCIAL_YOUTUBE_URL', 'SOCIAL_YOUTUBE_URL', 'https://www.youtube.com/', 'url', 1, '2023-11-02 08:21:53', '2023-11-02 08:21:53'),
        (18, 'PRIMARY_PHONE_NUMBER', 'FOOTER_PHONE_NUMBER', NULL, 'number', 1, '2023-11-02 08:21:53', '2024-05-01 01:42:22'),
        (21, 'PRIMARY_EMAIL', 'PRIMARY_EMAIL', 'info@gretsauniversity.ac.ke', 'email', 1, '2023-11-02 08:21:53', '2023-11-02 08:21:53'),
        (28, 'APPLY_NOW', 'apply-now', NULL, 'url', 1, '2023-11-07 07:26:13', '2023-11-07 07:26:13'),
        (29, 'SECONDARY_EMAIL', 'SECONDARY_EMAIL', NULL, 'email', 1, '2023-11-10 05:00:49', '2023-11-10 05:00:49'),
        (44, 'LOGO', 'logo', 'storage/uploads/cms/settings/1715233799-96725.png', 'image', 1, '2024-03-19 08:56:15', '2024-05-09 00:19:59'),
        (45, 'FAV_ICON', 'Fav-icon', 'storage/uploads/cms/settings/1714549482-50832.ico', 'image', 1, '2024-03-19 08:56:15', '2024-05-01 02:14:42'),
        (46, 'SUB_HEADER_BANNER_IMAGE', 'sub-header-banner-image', 'storage/uploads/cms/settings/1714549576-47901.ico', 'image', 1, '2024-03-19 13:57:29', '2024-05-01 02:16:16'),
        (47, 'PRIMARY_COLOR', 'PRIMARY-COLOR', '#1a2841', 'color', 1, '2024-03-19 13:57:29', '2024-05-09 00:21:08'),
        (48, 'SECONDRY_COLOR', 'SECONDRY-COLOR', '#1a2841', 'color', 1, '2024-03-19 13:57:29', '2024-05-09 00:19:59'),
        (49, 'ACTIVE_THEME', 'ACTIVE-THEME', 'Aman5537jains\\AbnCmsTheme\\AbnCmsTheme', 'string', 1, '2024-03-19 13:57:29', '2024-05-01 05:30:02'),
        (50, 'BACKEND_ACTIVE_THEME', 'BACKEND-ACTIVE-THEME', 'Aman5537jains\\AbnCmsAdminTheme\\AbnCmsAdminTheme', 'string', 1, '2024-03-19 13:57:29', '2024-05-01 05:30:02');
        ");


        \DB::statement("ALTER TABLE `settings` ADD PRIMARY KEY (`id`);");

        \DB::statement("ALTER TABLE `settings` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT");

        Setting::where("name","BACKEND_ACTIVE_THEME")->update(["description"=>"Aman5537jains\\AbnCmsAdminTheme\\AbnCmsAdminTheme"]);
        Setting::where("name","ACTIVE_THEME")->update(["description"=>"Aman5537jains\\AbnCmsTheme\\AbnCmsTheme"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
