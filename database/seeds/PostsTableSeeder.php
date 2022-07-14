<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('posts')->delete();
        
        \DB::table('posts')->insert(array (
            0 => 
            array (
                'id' => 2,
                'title' => 'This is first title',
                'subtitle' => 'subtitle',
                'slug' => 'ajax',
                'body' => '<p>Never in all their history have men been able truly to conceive of the world as one: a single sphere, a globe, having the qualities of a globe, a round earth in which all the directions eventually meet, in which there is no center because every point, or none, is center &mdash; an equal earth which all men occupy as equals. The airman&#39;s earth, if free men make it, will be truly round: a globe in practice, not in theory.</p>

<p>Science cuts two ways, of course; its products can be used for both good and evil. But there&#39;s no turning back from science. The early warnings about technological dangers also come from science.</p>

<p>What was most significant about the lunar voyage was not that man set foot on the Moon but that they set eye on the earth.</p>

<p>A Chinese tale tells of some men sent to harm a young girl who, upon seeing her beauty, become her protectors rather than her violators. That&#39;s how I felt seeing the Earth for the first time. I could not help but love and cherish her.</p>

<p>For those who have seen the Earth from space, and for the hundreds and perhaps thousands more who will, the experience most certainly changes your perspective. The things that we share in our world are far more valuable than those which divide us.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<pre>
<code class="language-css"> p {color :red;} </code></pre>

<p>&nbsp;</p>

<h2>The Final Frontier</h2>

<p>There can be no thought of finishing for &lsquo;aiming for the stars.&rsquo; Both figuratively and literally, it is a task to occupy the generations. And no matter how much progress one makes, there is always the thrill of just beginning.</p>

<p>There can be no thought of finishing for &lsquo;aiming for the stars.&rsquo; Both figuratively and literally, it is a task to occupy the generations. And no matter how much progress one makes, there is always the thrill of just beginning.</p>

<blockquote>The dreams of yesterday are the hopes of today and the reality of tomorrow. Science has not yet mastered prophecy. We predict too much for the next year and yet far too little for the next ten.</blockquote>

<p>Spaceflights cannot be stopped. This is not the work of any one man or even a group of men. It is a historical process which mankind is carrying out in accordance with the natural laws of human development.</p>

<h2>Reaching for the Stars</h2>

<p>As we got further and further away, it [the Earth] diminished in size. Finally it shrank to the size of a marble, the most beautiful you can imagine. That beautiful, warm, living object looked so fragile, so delicate, that if you touched it with a finger it would crumble and fall apart. Seeing this has to change a man.</p>

<p><a href="http://localhost:8000/post#"><img alt="" src="http://localhost:8000/img/post-sample-image.jpg" /></a>To go places and do things that have never been done before &ndash; that&rsquo;s what living is all about.</p>

<p>Space, the final frontier. These are the voyages of the Starship Enterprise. Its five-year mission: to explore strange new worlds, to seek out new life and new civilizations, to boldly go where no man has gone before.</p>

<p>As I stand out here in the wonders of the unknown at Hadley, I sort of realize there&rsquo;s a fundamental truth to our nature, Man must explore, and this is exploration at its greatest.</p>

<p>Placeholder text by&nbsp;<a href="http://spaceipsum.com/">Space Ipsum</a>. Photographs by&nbsp;<a href="https://www.flickr.com/photos/nasacommons/">NASA on The Commons</a>.</p>',
                'status' => 1,
                'posted_by' => NULL,
                'image' => 'public/O3R4eP4aVHeEIUPBAI4kROs2T86pWFfByzYhcoLi.jpeg',
                'created_at' => '2017-06-26 07:54:20',
                'updated_at' => '2017-07-10 16:23:14',
            ),
            1 => 
            array (
                'id' => 161,
                'title' => 'This is second',
                'subtitle' => 'second',
                'slug' => 'second',
                'body' => '<p>this is second</p>',
                'status' => 1,
                'posted_by' => NULL,
                'image' => NULL,
                'created_at' => '2017-07-04 08:14:04',
                'updated_at' => '2017-07-04 08:14:04',
            ),
            2 => 
            array (
                'id' => 162,
                'title' => 'this is third',
                'subtitle' => 'third',
                'slug' => 'third',
                'body' => '<p>this is thrid</p>',
                'status' => 1,
                'posted_by' => NULL,
                'image' => NULL,
                'created_at' => '2017-07-04 08:14:24',
                'updated_at' => '2017-07-04 08:14:24',
            ),
            3 => 
            array (
                'id' => 163,
                'title' => 'this is fourth',
                'subtitle' => 'fourth',
                'slug' => 'fourth',
                'body' => '<p>this is fourth</p>',
                'status' => 1,
                'posted_by' => NULL,
                'image' => NULL,
                'created_at' => '2017-07-04 08:14:41',
                'updated_at' => '2017-07-04 08:14:41',
            ),
            4 => 
            array (
                'id' => 164,
                'title' => 'this is fifth',
                'subtitle' => 'fifth',
                'slug' => 'fifth',
                'body' => '<p>this is fifth</p>',
                'status' => 1,
                'posted_by' => NULL,
                'image' => NULL,
                'created_at' => '2017-07-04 08:14:56',
                'updated_at' => '2017-07-04 08:14:56',
            ),
            5 => 
            array (
                'id' => 165,
                'title' => 'this is sixth',
                'subtitle' => 'sixth',
                'slug' => 'sixth',
                'body' => '<p>this is sixth</p>',
                'status' => 1,
                'posted_by' => NULL,
                'image' => NULL,
                'created_at' => '2017-07-04 08:15:30',
                'updated_at' => '2017-07-04 08:15:30',
            ),
            6 => 
            array (
                'id' => 166,
                'title' => 'this is seventh',
                'subtitle' => 'seventh',
                'slug' => 'seventh',
                'body' => '<p>this is seventh</p>',
                'status' => 1,
                'posted_by' => NULL,
                'image' => NULL,
                'created_at' => '2017-07-04 08:15:49',
                'updated_at' => '2017-07-04 08:15:49',
            ),
            7 => 
            array (
                'id' => 167,
                'title' => 'this is eighth',
                'subtitle' => 'eighth',
                'slug' => 'eighth',
                'body' => '<p>this is eighth</p>',
                'status' => 1,
                'posted_by' => NULL,
                'image' => NULL,
                'created_at' => '2017-07-04 08:16:46',
                'updated_at' => '2017-07-04 08:16:46',
            ),
            8 => 
            array (
                'id' => 168,
                'title' => 'this is ninth',
                'subtitle' => 'ninth',
                'slug' => 'ninth',
                'body' => '<p>this is ninth</p>',
                'status' => 1,
                'posted_by' => NULL,
                'image' => NULL,
                'created_at' => '2017-07-04 08:17:01',
                'updated_at' => '2017-07-04 08:17:01',
            ),
            9 => 
            array (
                'id' => 169,
                'title' => 'this is tenth',
                'subtitle' => 'tenth',
                'slug' => 'tenth',
                'body' => '<p>this is tenth</p>',
                'status' => 1,
                'posted_by' => NULL,
                'image' => 'public/ddPbyMEkUBJHXmf3iCUbyu53oXIhwPwBGwfvl1Go.jpeg',
                'created_at' => '2017-07-04 08:17:20',
                'updated_at' => '2017-07-10 16:29:05',
            ),
            10 => 
            array (
                'id' => 170,
                'title' => 'This is for file Upload',
                'subtitle' => 'file upload',
                'slug' => 'file-upload',
                'body' => '<h1 style="text-align:center"><strong>Bitfumes</strong></h1>

<p style="text-align:center">This is very nice because we have uploaded the file</p>',
                'status' => 1,
                'posted_by' => NULL,
                'image' => 'public/LoyuEI8fLb2z6I2mVKbEGaeqjG0yWMQXoLk2E1mg.jpeg',
                'created_at' => '2017-07-10 16:32:47',
                'updated_at' => '2017-08-03 11:28:15',
            ),
            11 => 
            array (
                'id' => 171,
                'title' => 'ahmed post',
                'subtitle' => 'ahmed post',
                'slug' => 'fakroune/post',
                'body' => '<p>hhhhhhhhhhhhhhhhhhh&nbsp;</p>',
                'status' => NULL,
                'posted_by' => NULL,
                'image' => '1657805381contact-bg.jpg',
                'created_at' => '2022-07-14 13:29:41',
                'updated_at' => '2022-07-14 13:29:41',
            ),
        ));
        
        
    }
}
