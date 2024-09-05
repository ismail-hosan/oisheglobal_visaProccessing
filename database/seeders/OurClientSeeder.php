<?php

namespace Database\Seeders;

use App\Models\OurClient;
use Illuminate\Database\Seeder;

class OurClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $our_clients = array(
            array('id' => '1', 'logo' => '/storage/OurClient/1640069254_01.1.png', 'orderNo' => '62', 'status' => 'Active', 'created_at' => '2021-12-21 06:39:30', 'updated_at' => '2021-12-22 06:45:20'),
            array('id' => '2', 'logo' => '/storage/OurClient/1640069408_02.1.png', 'orderNo' => '63', 'status' => 'Active', 'created_at' => '2021-12-21 06:39:30', 'updated_at' => '2021-12-22 06:45:28'),
            array('id' => '3', 'logo' => '/storage/OurClient/1640069352_04.1.png', 'orderNo' => '64', 'status' => 'Active', 'created_at' => '2021-12-21 06:39:30', 'updated_at' => '2021-12-22 06:45:41'),
            array('id' => '4', 'logo' => '/storage/OurClient/1640157501_05.1.png', 'orderNo' => '14', 'status' => 'Active', 'created_at' => '2021-12-21 06:39:30', 'updated_at' => '2021-12-22 07:18:21'),
            array('id' => '5', 'logo' => '/storage/OurClient/1640069451_06.1.png', 'orderNo' => '65', 'status' => 'Active', 'created_at' => '2021-12-21 06:39:30', 'updated_at' => '2021-12-22 06:45:54'),
            array('id' => '6', 'logo' => '/storage/OurClient/1640069473_7.1.png', 'orderNo' => '61', 'status' => 'Active', 'created_at' => '2021-12-21 06:39:30', 'updated_at' => '2021-12-22 06:45:09'),
            array('id' => '7', 'logo' => '/storage/OurClient/1640069498_8.1.png', 'orderNo' => '12', 'status' => 'Active', 'created_at' => '2021-12-21 06:39:30', 'updated_at' => '2021-12-22 06:37:19'),
            array('id' => '8', 'logo' => '/storage/OurClient/1640069521_10.1.png', 'orderNo' => '15', 'status' => 'Active', 'created_at' => '2021-12-21 06:39:30', 'updated_at' => '2021-12-22 06:42:41'),
            array('id' => '9', 'logo' => '/storage/OurClient/1640069552_11.1.png', 'orderNo' => '3', 'status' => 'Active', 'created_at' => '2021-12-21 06:39:30', 'updated_at' => '2021-12-22 06:24:17'),
            array('id' => '11', 'logo' => '/storage/OurClient/1640069765_12.1.png', 'orderNo' => '9', 'status' => 'Active', 'created_at' => '2021-12-21 06:56:05', 'updated_at' => '2021-12-22 06:38:56'),
            array('id' => '12', 'logo' => '/storage/OurClient/1640069786_13.1.png', 'orderNo' => '18', 'status' => 'Active', 'created_at' => '2021-12-21 06:56:26', 'updated_at' => '2021-12-27 07:02:29'),
            array('id' => '13', 'logo' => '/storage/OurClient/1640163946_14.1.png', 'orderNo' => '66', 'status' => 'Active', 'created_at' => '2021-12-21 06:56:41', 'updated_at' => '2021-12-22 09:05:46'),
            array('id' => '14', 'logo' => '/storage/OurClient/1640069813_15.1.png', 'orderNo' => '67', 'status' => 'Active', 'created_at' => '2021-12-21 06:56:53', 'updated_at' => '2021-12-22 06:46:59'),
            array('id' => '15', 'logo' => '/storage/OurClient/1640069826_16.1.png', 'orderNo' => '68', 'status' => 'Active', 'created_at' => '2021-12-21 06:57:06', 'updated_at' => '2021-12-22 06:47:20'),
            array('id' => '16', 'logo' => '/storage/OurClient/1640069840_17.1.png', 'orderNo' => '69', 'status' => 'Active', 'created_at' => '2021-12-21 06:57:20', 'updated_at' => '2021-12-22 06:47:44'),
            array('id' => '17', 'logo' => '/storage/OurClient/1640069853_18.1.png', 'orderNo' => '70', 'status' => 'Active', 'created_at' => '2021-12-21 06:57:33', 'updated_at' => '2021-12-22 06:48:18'),
            array('id' => '18', 'logo' => '/storage/OurClient/1640069871_19.1.png', 'orderNo' => '71', 'status' => 'Active', 'created_at' => '2021-12-21 06:57:51', 'updated_at' => '2021-12-22 06:48:42'),
            array('id' => '19', 'logo' => '/storage/OurClient/1640069883_20.1.png', 'orderNo' => '84', 'status' => 'Active', 'created_at' => '2021-12-21 06:58:03', 'updated_at' => '2021-12-22 06:52:24'),
            array('id' => '20', 'logo' => '/storage/OurClient/1640069896_21.1.png', 'orderNo' => '85', 'status' => 'Active', 'created_at' => '2021-12-21 06:58:16', 'updated_at' => '2021-12-22 06:52:50'),
            array('id' => '21', 'logo' => '/storage/OurClient/1640069915_23.1.png', 'orderNo' => '86', 'status' => 'Active', 'created_at' => '2021-12-21 06:58:35', 'updated_at' => '2021-12-22 06:53:13'),
            array('id' => '22', 'logo' => '/storage/OurClient/1640069930_24.1.png', 'orderNo' => '87', 'status' => 'Active', 'created_at' => '2021-12-21 06:58:50', 'updated_at' => '2021-12-22 06:53:34'),
            array('id' => '23', 'logo' => '/storage/OurClient/1640069947_25.1.png', 'orderNo' => '17', 'status' => 'Active', 'created_at' => '2021-12-21 06:59:07', 'updated_at' => '2021-12-22 06:44:40'),
            array('id' => '24', 'logo' => '/storage/OurClient/1640069958_26.1.png', 'orderNo' => '82', 'status' => 'Active', 'created_at' => '2021-12-21 06:59:18', 'updated_at' => '2021-12-22 06:51:50'),
            array('id' => '25', 'logo' => '/storage/OurClient/1640069974_28.1.png', 'orderNo' => '88', 'status' => 'Active', 'created_at' => '2021-12-21 06:59:34', 'updated_at' => '2021-12-22 06:53:55'),
            array('id' => '26', 'logo' => '/storage/OurClient/1640069995_29.1.png', 'orderNo' => '89', 'status' => 'Active', 'created_at' => '2021-12-21 06:59:55', 'updated_at' => '2021-12-22 06:54:09'),
            array('id' => '27', 'logo' => '/storage/OurClient/1640070010_30.1.png', 'orderNo' => '90', 'status' => 'Active', 'created_at' => '2021-12-21 07:00:10', 'updated_at' => '2021-12-22 06:54:28'),
            array('id' => '28', 'logo' => '/storage/OurClient/1640070024_31.1.png', 'orderNo' => '8', 'status' => 'Active', 'created_at' => '2021-12-21 07:00:24', 'updated_at' => '2021-12-22 06:41:29'),
            array('id' => '29', 'logo' => '/storage/OurClient/1640070037_32.1.png', 'orderNo' => '16', 'status' => 'Active', 'created_at' => '2021-12-21 07:00:37', 'updated_at' => '2021-12-22 06:44:07'),
            array('id' => '30', 'logo' => '/storage/OurClient/1640070050_33.1.png', 'orderNo' => '91', 'status' => 'Active', 'created_at' => '2021-12-21 07:00:50', 'updated_at' => '2021-12-22 06:54:55'),
            array('id' => '31', 'logo' => '/storage/OurClient/1640070072_34.1.png', 'orderNo' => '92', 'status' => 'Active', 'created_at' => '2021-12-21 07:01:12', 'updated_at' => '2021-12-22 06:55:11'),
            array('id' => '32', 'logo' => '/storage/OurClient/1640070090_35.1.png', 'orderNo' => '93', 'status' => 'Active', 'created_at' => '2021-12-21 07:01:30', 'updated_at' => '2021-12-22 06:55:29'),
            array('id' => '34', 'logo' => '/storage/OurClient/1640070120_36.1.png', 'orderNo' => '94', 'status' => 'Active', 'created_at' => '2021-12-21 07:02:00', 'updated_at' => '2021-12-22 06:55:56'),
            array('id' => '35', 'logo' => '/storage/OurClient/1640070133_37.1.png', 'orderNo' => '72', 'status' => 'Active', 'created_at' => '2021-12-21 07:02:13', 'updated_at' => '2021-12-22 06:49:16'),
            array('id' => '36', 'logo' => '/storage/OurClient/1640070151_38.1.png', 'orderNo' => '95', 'status' => 'Active', 'created_at' => '2021-12-21 07:02:31', 'updated_at' => '2021-12-22 06:56:13'),
            array('id' => '37', 'logo' => '/storage/OurClient/1640070165_39.1.png', 'orderNo' => '83', 'status' => 'Active', 'created_at' => '2021-12-21 07:02:45', 'updated_at' => '2021-12-22 06:52:07'),
            array('id' => '38', 'logo' => '/storage/OurClient/1640070192_40.1.png', 'orderNo' => '6', 'status' => 'Active', 'created_at' => '2021-12-21 07:03:12', 'updated_at' => '2021-12-22 06:36:47'),
            array('id' => '39', 'logo' => '/storage/OurClient/1640070221_41.1.png', 'orderNo' => '4', 'status' => 'Active', 'created_at' => '2021-12-21 07:03:41', 'updated_at' => '2021-12-22 06:30:17'),
            array('id' => '40', 'logo' => '/storage/OurClient/1640070896_02.1.png', 'orderNo' => '96', 'status' => 'Active', 'created_at' => '2021-12-21 07:14:05', 'updated_at' => '2021-12-22 06:56:40'),
            array('id' => '41', 'logo' => '/storage/OurClient/1640070867_43.1.png', 'orderNo' => '81', 'status' => 'Active', 'created_at' => '2021-12-21 07:14:27', 'updated_at' => '2021-12-22 06:51:24'),
            array('id' => '42', 'logo' => '/storage/OurClient/1640070911_44.1.png', 'orderNo' => '79', 'status' => 'Active', 'created_at' => '2021-12-21 07:15:11', 'updated_at' => '2021-12-22 06:50:35'),
            array('id' => '43', 'logo' => '/storage/OurClient/1640070922_46.1.png', 'orderNo' => '73', 'status' => 'Active', 'created_at' => '2021-12-21 07:15:22', 'updated_at' => '2021-12-22 06:49:31'),
            array('id' => '44', 'logo' => '/storage/OurClient/1640070933_47.1.png', 'orderNo' => '74', 'status' => 'Active', 'created_at' => '2021-12-21 07:15:33', 'updated_at' => '2021-12-22 06:49:44'),
            array('id' => '45', 'logo' => '/storage/OurClient/1640070944_48.1.png', 'orderNo' => '78', 'status' => 'Active', 'created_at' => '2021-12-21 07:15:44', 'updated_at' => '2021-12-22 06:50:12'),
            array('id' => '46', 'logo' => '/storage/OurClient/1640070956_49.1.png', 'orderNo' => '75', 'status' => 'Active', 'created_at' => '2021-12-21 07:15:56', 'updated_at' => '2021-12-22 06:49:59'),
            array('id' => '48', 'logo' => '/storage/OurClient/1640162926_50.1.png', 'orderNo' => '96', 'status' => 'Active', 'created_at' => '2021-12-22 08:48:46', 'updated_at' => '2021-12-22 08:48:46'),
            array('id' => '49', 'logo' => '/storage/OurClient/1640162954_51.1.png', 'orderNo' => '97', 'status' => 'Active', 'created_at' => '2021-12-22 08:49:14', 'updated_at' => '2021-12-22 08:49:14'),
            array('id' => '50', 'logo' => '/storage/OurClient/1640162972_52.1.png', 'orderNo' => '3', 'status' => 'Active', 'created_at' => '2021-12-22 08:49:32', 'updated_at' => '2021-12-27 07:22:33'),
            array('id' => '51', 'logo' => '/storage/OurClient/1640163009_53.1 (2).png', 'orderNo' => '98', 'status' => 'Active', 'created_at' => '2021-12-22 08:50:09', 'updated_at' => '2021-12-22 08:50:09'),
            array('id' => '52', 'logo' => '/storage/OurClient/1640163093_53.1.png', 'orderNo' => '99', 'status' => 'Active', 'created_at' => '2021-12-22 08:51:33', 'updated_at' => '2021-12-22 08:51:33'),
            array('id' => '53', 'logo' => '/storage/OurClient/1640163118_54.1.png', 'orderNo' => '100', 'status' => 'Active', 'created_at' => '2021-12-22 08:51:58', 'updated_at' => '2021-12-22 08:51:58'),
            array('id' => '54', 'logo' => '/storage/OurClient/1640163136_55.1.png', 'orderNo' => '101', 'status' => 'Active', 'created_at' => '2021-12-22 08:52:16', 'updated_at' => '2021-12-22 08:52:16'),
            array('id' => '55', 'logo' => '/storage/OurClient/1640163156_56.1.png', 'orderNo' => '102', 'status' => 'Active', 'created_at' => '2021-12-22 08:52:36', 'updated_at' => '2021-12-22 08:52:36'),
            array('id' => '56', 'logo' => '/storage/OurClient/1640163198_58.1.png', 'orderNo' => '103', 'status' => 'Active', 'created_at' => '2021-12-22 08:53:18', 'updated_at' => '2021-12-22 08:53:18'),
            array('id' => '57', 'logo' => '/storage/OurClient/1640163224_59.1.png', 'orderNo' => '104', 'status' => 'Active', 'created_at' => '2021-12-22 08:53:44', 'updated_at' => '2021-12-22 08:53:44'),
            array('id' => '58', 'logo' => '/storage/OurClient/1640163245_60.1.png', 'orderNo' => '105', 'status' => 'Active', 'created_at' => '2021-12-22 08:54:05', 'updated_at' => '2021-12-22 08:54:05'),
            array('id' => '59', 'logo' => '/storage/OurClient/1640163262_61.1.png', 'orderNo' => '106', 'status' => 'Active', 'created_at' => '2021-12-22 08:54:22', 'updated_at' => '2021-12-22 08:54:22'),
            array('id' => '60', 'logo' => '/storage/OurClient/1640163285_63.1.png', 'orderNo' => '107', 'status' => 'Active', 'created_at' => '2021-12-22 08:54:45', 'updated_at' => '2021-12-22 08:54:45'),
            array('id' => '61', 'logo' => '/storage/OurClient/1640163300_64.1.png', 'orderNo' => '108', 'status' => 'Active', 'created_at' => '2021-12-22 08:55:00', 'updated_at' => '2021-12-22 08:55:00'),
            array('id' => '62', 'logo' => '/storage/OurClient/1640163313_65.1.png', 'orderNo' => '109', 'status' => 'Active', 'created_at' => '2021-12-22 08:55:13', 'updated_at' => '2021-12-22 08:55:13'),
            array('id' => '63', 'logo' => '/storage/OurClient/1640163615_67.1.png', 'orderNo' => '110', 'status' => 'Active', 'created_at' => '2021-12-22 08:55:26', 'updated_at' => '2021-12-22 09:00:15'),
            array('id' => '70', 'logo' => '/storage/OurClient/1640587848_75.1.png', 'orderNo' => '1', 'status' => 'Active', 'created_at' => '2021-12-27 06:50:48', 'updated_at' => '2021-12-27 06:50:48'),
            array('id' => '71', 'logo' => '/storage/OurClient/1640588103_Picture6.1.png', 'orderNo' => '11', 'status' => 'Active', 'created_at' => '2021-12-27 06:51:31', 'updated_at' => '2021-12-27 06:55:03'),
            array('id' => '67', 'logo' => '/storage/OurClient/1640587511_74.1.png', 'orderNo' => '5', 'status' => 'Active', 'created_at' => '2021-12-27 06:45:11', 'updated_at' => '2021-12-27 06:45:11'),
            array('id' => '72', 'logo' => '/storage/OurClient/1640588049_Picture3.1.png', 'orderNo' => '2', 'status' => 'Active', 'created_at' => '2021-12-27 06:54:09', 'updated_at' => '2021-12-27 06:59:47'),
            array('id' => '73', 'logo' => '/storage/OurClient/1640588159_Picture11.1.png', 'orderNo' => '111', 'status' => 'Active', 'created_at' => '2021-12-27 06:55:59', 'updated_at' => '2021-12-27 06:55:59'),
            array('id' => '74', 'logo' => '/storage/OurClient/1640588176_Picture6.1.png', 'orderNo' => '112', 'status' => 'Active', 'created_at' => '2021-12-27 06:56:16', 'updated_at' => '2021-12-27 06:56:16'),
            array('id' => '75', 'logo' => '/storage/OurClient/1640588298_70.1.png', 'orderNo' => '113', 'status' => 'Active', 'created_at' => '2021-12-27 06:58:18', 'updated_at' => '2021-12-27 06:58:18'),
            array('id' => '76', 'logo' => '/storage/OurClient/1640588333_69.1.png', 'orderNo' => '115', 'status' => 'Active', 'created_at' => '2021-12-27 06:58:53', 'updated_at' => '2021-12-27 07:01:15'),
            array('id' => '77', 'logo' => '/storage/OurClient/1640588688_Picture1.1.png', 'orderNo' => '19', 'status' => 'Active', 'created_at' => '2021-12-27 07:04:48', 'updated_at' => '2021-12-27 07:04:48'),
            array('id' => '78', 'logo' => '/storage/OurClient/1640588719_Untitled-1.1.png', 'orderNo' => '20', 'status' => 'Active', 'created_at' => '2021-12-27 07:05:19', 'updated_at' => '2021-12-27 07:05:19'),
            array('id' => '79', 'logo' => '/storage/OurClient/1640589144_78.1.png', 'orderNo' => '7', 'status' => 'Active', 'created_at' => '2021-12-27 07:09:37', 'updated_at' => '2021-12-27 07:12:24'),
            array('id' => '80', 'logo' => '/storage/OurClient/1640589703_Untitled-2.1.jpg', 'orderNo' => '122', 'status' => 'Active', 'created_at' => '2021-12-27 07:21:43', 'updated_at' => '2021-12-27 07:21:43'),
            array('id' => '81', 'logo' => '/storage/OurClient/1640605650_Untitled-1.png', 'orderNo' => '2', 'status' => 'Active', 'created_at' => '2021-12-27 11:47:30', 'updated_at' => '2021-12-27 11:47:30')
        );


        OurClient::insert($our_clients);
    }
}
