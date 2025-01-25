<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /**
         * Users Table Seeder
         */

        \App\Models\User::factory()->create([
            'username' => 'grgjose',
            'usertype' => 1,
            'fname' => 'George Louis',
            'mname' => 'Martinez',
            'lname' => 'Jose',
            'email' => 'georgelouisjose@gmail.com',
            'status' => 'active',
            'email_verified_at' => now(),
            'birthdate' => date("1999-04-16"),
            'contact_num' => '09363362225',
            'profile_pic' => '1.jpg',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        \App\Models\User::factory()->create([
            'username' => 'jeey',
            'usertype' => 1,
            'fname' => 'Jeey',
            'mname' => '',
            'lname' => 'Bautista',
            'email' => 'jeey.bautista@gmail.com',
            'status' => 'active',
            'email_verified_at' => now(),
            //'birthdate' => date("1999-04-16"),
            //'contact_num' => '09363362225',
            'profile_pic' => 'default.jpg',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        \App\Models\User::factory()->create([
            'username' => 'juliet',
            'usertype' => 1,
            'fname' => 'Juliet',
            'mname' => '',
            'lname' => 'Martinez',
            'email' => 'juliet.martinez@gmail.com',
            'status' => 'active',
            'email_verified_at' => now(),
            //'birthdate' => date("1999-04-16"),
            //'contact_num' => '09363362225',
            'profile_pic' => 'default.jpg',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        /**
         * Programs Table Seeder
         */
        
        \App\Models\Program::factory()->create([
            'code' => 'D-180',
            'description' => 'Dayong Cash Assistance Programs',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'D-190',
            'description' => 'Dayong Cash Assistance Programs',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'D-280',
            'description' => 'Dayong Cash Assistance Programs',
            'with_beneficiaries' => true,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'D-290',
            'description' => 'Dayong Cash Assistance Programs',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'D-230',
            'description' => 'Dayong Cash Assistance Programs',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'D-300',
            'description' => 'Dayong Cash Assistance Programs',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'D-460',
            'description' => 'Dayong Cash Assistance Programs',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'D-350',
            'description' => 'Dayong Paid the Balance',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'D-420',
            'description' => 'Dayong Paid the Balance',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'D-410',
            'description' => 'Dayong Paid the Balance',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'M-150',
            'description' => 'Dayong Paid the Balance',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'M-250',
            'description' => 'Dayong Paid the Balance',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'DC-260',
            'description' => 'Dayong Citizen',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'DC-300',
            'description' => 'Dayong Citizen',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'DC-180',
            'description' => 'Dayong Citizen',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'D-179',
            'description' => 'Dayong Special Programs',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'D-290',
            'description' => 'Dayong Special Programs',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'D-390',
            'description' => 'Dayong Special Programs',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'D-270',
            'description' => 'Dayong Special Programs',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'D-370',
            'description' => 'Dayong Special Programs',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'D-320',
            'description' => 'Dayong Special Programs',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'D-185',
            'description' => 'Dayong Special Programs',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'DPP-650',
            'description' => 'Dayong Special Programs',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'D-550',
            'description' => 'Dayong Family Package',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);
        
        \App\Models\Program::factory()->create([
            'code' => 'D-650',
            'description' => 'Dayong Family Package',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        \App\Models\Program::factory()->create([
            'code' => 'D-480',
            'description' => 'Dayong Family Package',
            'with_beneficiaries' => false,
            'age_min' => null,
            'age_max' => null,
        ]);

        /**
         * Branches Table Seeder
         */

        \App\Models\Branch::factory()->create([
            'code' => '0001',
            'city' => 'METRO DAVAO',
            'branch' => 'AGDAO',
            'address' => '-',
            'description' => '-',
        ]);

        \App\Models\Branch::factory()->create([
            'code' => '0002',
            'city' => 'METRO DAVAO',
            'branch' => 'TIBUNGCO',
            'address' => '-',
            'description' => '-',
        ]);

        \App\Models\Branch::factory()->create([
            'code' => '0003',
            'city' => 'METRO DAVAO',
            'branch' => 'BUHANGIN',
            'address' => '-',
            'description' => '-',
        ]);

        \App\Models\Branch::factory()->create([
            'code' => '0004',
            'city' => 'METRO DAVAO',
            'branch' => 'MATINA',
            'address' => '-',
            'description' => '-',
        ]);

        \App\Models\Branch::factory()->create([
            'code' => '0005',
            'city' => 'METRO DAVAO',
            'branch' => 'STA. CRUZ',
            'address' => '-',
            'description' => '-',
        ]);

        \App\Models\Branch::factory()->create([
            'code' => '0006',
            'city' => 'METRO DAVAO',
            'branch' => 'TORIL',
            'address' => '-',
            'description' => '-',
        ]);

        \App\Models\Branch::factory()->create([
            'code' => '0007',
            'city' => 'METRO DAVAO',
            'branch' => 'CALINAN',
            'address' => '-',
            'description' => '-',
        ]);

        \App\Models\Branch::factory()->create([
            'code' => '0008',
            'city' => 'METRO DAVAO',
            'branch' => 'MINTAL',
            'address' => '-',
            'description' => '-',
        ]);

        \App\Models\Branch::factory()->create([
            'code' => '0009',
            'city' => 'METRO DAVAO',
            'branch' => 'MARILOG',
            'address' => '-',
            'description' => '-',
        ]);

        \App\Models\Branch::factory()->create([
            'code' => '0010',
            'city' => 'DAVAO DEL NORTE',
            'branch' => 'TAGUM',
            'address' => '-',
            'description' => '-',
        ]);

        \App\Models\Branch::factory()->create([
            'code' => '0011',
            'city' => 'DAVAO DEL NORTE',
            'branch' => 'LA FILIPINA',
            'address' => '-',
            'description' => '-',
        ]);

        \App\Models\Branch::factory()->create([
            'code' => '0012',
            'city' => 'DAVAO DE ORO',
            'branch' => 'MACO',
            'address' => '-',
            'description' => '-',
        ]);

        \App\Models\Branch::factory()->create([
            'code' => '0013',
            'city' => 'DAVAO DE ORO',
            'branch' => 'MABINI',
            'address' => '-',
            'description' => '-',
        ]);

        \App\Models\Branch::factory()->create([
            'code' => '0014',
            'city' => 'DAVAO DE ORO',
            'branch' => 'PANTUKAN',
            'address' => '-',
            'description' => '-',
        ]);

        \App\Models\Branch::factory()->create([
            'code' => '0015',
            'city' => 'DAVAO DE ORO',
            'branch' => 'MARAGUSAN',
            'address' => '-',
            'description' => '-',
        ]);

        \App\Models\Branch::factory()->create([
            'code' => '0016',
            'city' => 'DAVAO DE ORO',
            'branch' => 'NABUNTURAN',
            'address' => '-',
            'description' => '-',
        ]);

        \App\Models\Branch::factory()->create([
            'code' => '0017',
            'city' => 'DAVAO DE ORO',
            'branch' => 'LUPON',
            'address' => '-',
            'description' => '-',
        ]);

        \App\Models\Branch::factory()->create([
            'code' => '0018',
            'city' => 'SURIGAO DEL SUR',
            'branch' => 'HINATUAN',
            'address' => '-',
            'description' => '-',
        ]);

        \App\Models\Branch::factory()->create([
            'code' => '0019',
            'city' => 'SURIGAO DEL SUR',
            'branch' => 'TAGBINA',
            'address' => '-',
            'description' => '-',
        ]);

        \App\Models\Branch::factory()->create([
            'code' => '0020',
            'city' => 'SURIGAO DEL SUR',
            'branch' => 'BUTUAN',
            'address' => '-',
            'description' => '-',
        ]);

    }
}
