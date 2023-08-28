<?php

use Pvtl\VoyagerPages\Page;
use Illuminate\Database\Seeder;

class PagesModuleTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        // Create a Home Page
        $page = $this->findPage('home');
        if (!$page->exists) {
            $page->fill([
                'title' => 'Home',
                'author_id' => 0,
                'excerpt' => 'This is the excerpt for the Lorem Ipsum Page',
                'body' => '<p><br /></p><h3 class="text-center">This is the body of the lorem ipsum page</h3><p class="text-center">This is the body of the lorem ipsum page</p><p><br /></p>',
                'image' => 'pages/page1.jpg',
                'slug' => 'home',
                'meta_description' => 'This is the meta description',
                'status' => 'ACTIVE',
            ])->save();
        }

        // Create an About Page
        $page = $this->findPage('about');
        if (!$page->exists) {
            $page->fill([
                'title' => 'About',
                'author_id' => 0,
                'excerpt' => 'This is the excerpt for the Lorem Ipsum Page',
                'body' => '<p><br /></p><h3 class="text-center">This is the body of the lorem ipsum page</h3><p class="text-center">This is the body of the lorem ipsum page</p><p><br /></p>',
                'image' => 'posts/post2.jpg',
                'slug' => 'about',
                'meta_description' => 'This is the meta description for about',
                'status' => 'ACTIVE',
            ])->save();
        }

        // Create a Contact Page
        $page = $this->findPage('contact');
        if (!$page->exists) {
            $page->fill([
                'title' => 'Contact',
                'author_id' => 0,
                'excerpt' => 'This is the excerpt for the Lorem Ipsum Page',
                'body' => '<p><br /></p><h3 class="text-center">This is the body of the lorem ipsum page</h3><p class="text-center">This is the body of the lorem ipsum page</p><p><br /></p>',
                'image' => 'posts/post2.jpg',
                'slug' => 'contact',
                'meta_description' => 'This is the meta description for contact',
                'status' => 'ACTIVE',
            ])->save();
        }
    }

    protected function findPage($slug)
    {
        return Page::firstOrNew(['slug' => $slug]);
    }
}
