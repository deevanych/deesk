<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('issues')->insert([
            'title' => 'Супертест',
            'description' => 'Лвадлывопдлтивы ыдлароылвти полывртложвыртполвы влопрыволртп волыпртовлыпи тврыолпи выолпрвыолпрвыложпи ыволпрыволаи ыолвар ыволар олвыраолврвылоар ыволжарывол раывложар ыволар ыволаролырало ывртагжвыртагывати ывашрзыв гартвы тагыари грывагывригшрыватгшрыв гшарывгаш рывагывршгывгшрывгшывра ывра шарыв гшывроа ыволроа лывоалд ывоадл ывод лао ылдвоадыв',
            'organization_id' => 1,
            'author_organization_id' => 2,
            'issue_type_id' => 1,
            'issue_status_id' => 1,
            'issue_priority_id' => 1,
            'author_id' => 3,
            'registration_type_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('issues')->insert([
            'title' => 'Второй тест',
            'description' => 'Лвадлывопдлтивы ыдлароылвти полывртложвыртполвы влопрыволртп волыпртовлыпи тврыолпи выолпрвыолпрвыложпи ыволпрыволаи ыолвар ыволар олвыраолврвылоар ыволжарывол раывложар ыволар ыволаролырало ывртагжвыртагывати ывашрзыв гартвы тагыари грывагывригшрыватгшрыв гшарывгаш рывагывршгывгшрывгшывра ывра шарыв гшывроа ыволроа лывоалд ывоадл ывод лао ылдвоадыв',
            'organization_id' => 1,
            'author_organization_id' => 3,
            'issue_type_id' => 1,
            'issue_status_id' => 2,
            'issue_priority_id' => 1,
            'author_id' => 4,
            'registration_type_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
