<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //permission for settings
         Permission::create(['name' => 'settings.index']);
         Permission::create(['name' => 'settings.create']);
         Permission::create(['name' => 'settings.edit']);
         Permission::create(['name' => 'settings.delete']);
 
         //permission for menus
         Permission::create(['name' => 'menus.index']);
         Permission::create(['name' => 'menus.create']);
         Permission::create(['name' => 'menus.edit']);
         Permission::create(['name' => 'menus.delete']);
 
         //permission for socialmedia
         Permission::create(['name' => 'socialmedia.index']);
         Permission::create(['name' => 'socialmedia.create']);
         Permission::create(['name' => 'socialmedia.edit']);
         Permission::create(['name' => 'socialmedia.delete']);
         
         //permission for institutions
         Permission::create(['name' => 'institutions.index']);
         Permission::create(['name' => 'institutions.create']);
         Permission::create(['name' => 'institutions.edit']);
         Permission::create(['name' => 'institutions.delete']);
        
         //permission for schoollevels
         Permission::create(['name' => 'schoollevels.index']);
         Permission::create(['name' => 'schoollevels.create']);
         Permission::create(['name' => 'schoollevels.edit']);
         Permission::create(['name' => 'schoollevels.delete']);
 
         //permission for schools
         Permission::create(['name' => 'schools.index']);
         Permission::create(['name' => 'schools.create']);
         Permission::create(['name' => 'schools.edit']);
         Permission::create(['name' => 'schools.delete']);
         
         //permission for teachers
         Permission::create(['name' => 'teachers.index']);
         Permission::create(['name' => 'teachers.create']);
         Permission::create(['name' => 'teachers.edit']);
         Permission::create(['name' => 'teachers.delete']);
         
         //permission for students
         Permission::create(['name' => 'students.index']);
         Permission::create(['name' => 'students.create']);
         Permission::create(['name' => 'students.edit']);
         Permission::create(['name' => 'students.delete']);
         
         //permission for academicyears
         Permission::create(['name' => 'academicyears.index']);
         Permission::create(['name' => 'academicyears.create']);
         Permission::create(['name' => 'academicyears.edit']);
         Permission::create(['name' => 'academicyears.delete']);
         
         //permission for curiculums
         Permission::create(['name' => 'curiculums.index']);
         Permission::create(['name' => 'curiculums.create']);
         Permission::create(['name' => 'curiculums.edit']);
         Permission::create(['name' => 'curiculums.delete']);
 
         //permission for departments
         Permission::create(['name' => 'departments.index']);
         Permission::create(['name' => 'departments.create']);
         Permission::create(['name' => 'departments.edit']);
         Permission::create(['name' => 'departments.delete']);
 
         //permission for levelclasses
         Permission::create(['name' => 'levelclasses.index']);
         Permission::create(['name' => 'levelclasses.create']);
         Permission::create(['name' => 'levelclasses.edit']);
         Permission::create(['name' => 'levelclasses.delete']);
        
         //permission for studygroups
         Permission::create(['name' => 'studygroups.index']);
         Permission::create(['name' => 'studygroups.create']);
         Permission::create(['name' => 'studygroups.edit']);
         Permission::create(['name' => 'studygroups.delete']);
         
         //permission for courses
         Permission::create(['name' => 'courses.index']);
         Permission::create(['name' => 'courses.create']);
         Permission::create(['name' => 'courses.edit']);
         Permission::create(['name' => 'courses.delete']);
 
         //permission for coursstudygroups
         Permission::create(['name' => 'coursstudygroups.index']);
         Permission::create(['name' => 'coursstudygroups.create']);
         Permission::create(['name' => 'coursstudygroups.edit']);
         Permission::create(['name' => 'coursstudygroups.delete']);
 
         //permission for chapters
         Permission::create(['name' => 'chapters.index']);
         Permission::create(['name' => 'chapters.create']);
         Permission::create(['name' => 'chapters.edit']);
         Permission::create(['name' => 'chapters.delete']);
 
         //permission for screenshoots
         Permission::create(['name' => 'screenshoots.index']);
         Permission::create(['name' => 'screenshoots.create']);
         Permission::create(['name' => 'screenshoots.edit']);
         Permission::create(['name' => 'screenshoots.delete']);
 
         //permission for tools
         Permission::create(['name' => 'tools.index']);
         Permission::create(['name' => 'tools.create']);
         Permission::create(['name' => 'tools.edit']);
         Permission::create(['name' => 'tools.delete']);
 
         //permission for lessons
         Permission::create(['name' => 'lessons.index']);
         Permission::create(['name' => 'lessons.create']);
         Permission::create(['name' => 'lessons.edit']);
         Permission::create(['name' => 'lessons.delete']);
 
         //permission for schedules
         Permission::create(['name' => 'schedules.index']);
         Permission::create(['name' => 'schedules.create']);
         Permission::create(['name' => 'schedules.edit']);
         Permission::create(['name' => 'schedules.delete']);
  
         //permission for exams
         Permission::create(['name' => 'exams.index']);
         Permission::create(['name' => 'exams.create']);
         Permission::create(['name' => 'exams.edit']);
         Permission::create(['name' => 'exams.delete']);
        
         //permission for questions
         Permission::create(['name' => 'questions.index']);
         Permission::create(['name' => 'questions.create']);
         Permission::create(['name' => 'questions.edit']);
         Permission::create(['name' => 'questions.delete']);
         
         //permission for scores
         Permission::create(['name' => 'scores.index']);
         Permission::create(['name' => 'scores.create']);
         Permission::create(['name' => 'scores.edit']);
         Permission::create(['name' => 'scores.delete']);
         
         
         //permission for categories
         Permission::create(['name' => 'categoryposts.index']);
         Permission::create(['name' => 'categoryposts.create']);
         Permission::create(['name' => 'categoryposts.edit']);
         Permission::create(['name' => 'categoryposts.delete']);
 
         //permission for setarticles
         Permission::create(['name' => 'setarticles.index']);
         Permission::create(['name' => 'setarticles.create']);
         Permission::create(['name' => 'setarticles.edit']);
         Permission::create(['name' => 'setarticles.delete']);
 
         //permission for categorypages
         Permission::create(['name' => 'categorypages.index']);
         Permission::create(['name' => 'categorypages.create']);
         Permission::create(['name' => 'categorypages.edit']);
         Permission::create(['name' => 'categorypages.delete']);
 
         //permission for tags
         Permission::create(['name' => 'tags.index']);
         Permission::create(['name' => 'tags.create']);
         Permission::create(['name' => 'tags.edit']);
         Permission::create(['name' => 'tags.delete']);
         //permission for posts
         Permission::create(['name' => 'posts.index']);
         Permission::create(['name' => 'posts.create']);
         Permission::create(['name' => 'posts.edit']);
         Permission::create(['name' => 'posts.delete']);
         //permission for pages
         Permission::create(['name' => 'pages.index']);
         Permission::create(['name' => 'pages.create']);
         Permission::create(['name' => 'pages.edit']);
         Permission::create(['name' => 'pages.delete']);
 
         //permission for albums
         Permission::create(['name' => 'albums.index']);
         Permission::create(['name' => 'albums.create']);
         Permission::create(['name' => 'albums.edit']);
         Permission::create(['name' => 'albums.delete']);
         
         //permission for photos
         Permission::create(['name' => 'photos.index']);
         Permission::create(['name' => 'photos.create']);
         Permission::create(['name' => 'photos.edit']);
         Permission::create(['name' => 'photos.delete']);
 
         //permission for sliders
         Permission::create(['name' => 'sliders.index']);
         Permission::create(['name' => 'sliders.create']);
         Permission::create(['name' => 'sliders.edit']);
         Permission::create(['name' => 'sliders.delete']);
  
         //permission for roles
         Permission::create(['name' => 'roles.index']);
         Permission::create(['name' => 'roles.create']);
         Permission::create(['name' => 'roles.edit']);
         Permission::create(['name' => 'roles.delete']);
  
         //permission for permissions
         Permission::create(['name' => 'permissions.index']);
         Permission::create(['name' => 'permissions.create']);
         Permission::create(['name' => 'permissions.edit']);
         Permission::create(['name' => 'permissions.delete']);
  
         //permission for users
         Permission::create(['name' => 'users.index']);
         Permission::create(['name' => 'users.create']);
         Permission::create(['name' => 'users.edit']);
         Permission::create(['name' => 'users.delete']);
          
         //permission for advertisements
         Permission::create(['name' => 'advertisements.index']);
         Permission::create(['name' => 'advertisements.create']);
         Permission::create(['name' => 'advertisements.edit']);
         Permission::create(['name' => 'advertisements.delete']);
        
         //permission for categorydownloads
         Permission::create(['name' => 'categorydownloads.index']);
         Permission::create(['name' => 'categorydownloads.create']);
         Permission::create(['name' => 'categorydownloads.edit']);
         Permission::create(['name' => 'categorydownloads.delete']);

         //permission for widgets
         Permission::create(['name' => 'widgets.index']);
         Permission::create(['name' => 'widgets.create']);
         Permission::create(['name' => 'widgets.edit']);
         Permission::create(['name' => 'widgets.delete']);

       //permission for downloadfiles
        Permission::create(['name' => 'downloadfiles.index']);
        Permission::create(['name' => 'downloadfiles.create']);
        Permission::create(['name' => 'downloadfiles.edit']);
        Permission::create(['name' => 'downloadfiles.delete']);
        
        //permission for links
        Permission::create(['name' => 'links.index']);
        Permission::create(['name' => 'links.create']);
        Permission::create(['name' => 'links.edit']);
        Permission::create(['name' => 'links.delete']);
    }
}
