<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = config('db.projects');
        foreach ($projects as $project) {
            $newProject = new Project;
            $newProject->title = $project['title'];
            $newProject->description = $project['description'];
            $newProject->url = $project['url'];
            $newProject->user_id = $project['user_id'];
            $newProject->tecnologies = $project['tecnologies'];
            $newProject->slug = Str::slug($project['title'] . '-');
            $newProject->image = ProjectSeeder::storeimage(__DIR__ . '/images/' . $newProject->slug . '.png', $newProject->slug);
            $newProject->save();
        }
    }

    public static function storeimage($img, $name)
    {
        //$url = 'https:' . $img;
        $url = $img;
        $contents = file_get_contents($url);
        // $temp_name = substr($url, strrpos($url, '/') + 1);
        // $name = substr($temp_name, 0, strpos($temp_name, '?')) . '.jpg';
        $path = 'images/icon_types/' . $name . '.png';
        Storage::put('images/icon_types/' . $name . '.png', $contents);
        return $path;
    }
}
