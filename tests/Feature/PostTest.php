    <?php

    namespace Tests\Feature;

    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;
    use App\BlogPost;

    class PostTest extends TestCase
    {
    use RefreshDatabase;
    public function testNoBlogPostWhenNothingInDatabase()
    {
    $response = $this->get('/posts');

    $response->assertSeeText('No blog posts yet!')
    }
    public function testSee1BlogPostWhenThereIs1()
    {
        $post = $this->createDummyBlogPost()

    $response = $this->get('/posts');
    $response->assertSeeText('New title');

    $this->assertDatabaseHas('blog_posts', [
        'title' => 'New title'
    ]);
    }
    public function testStoreValid()
    {
        $params = [
            'title'=>'Valid title',
            'content' => 'At least 10 characters'
        ];

        $this->post('/post', $params)->assertStatus(302)->assertSessionHas('status');

        $this->assertEquals(session('status'),'Blog post was created!');
    }
    public function testStoreFail()
    {
        $params = [
            'title'=> 'x',
            'content'=> 'x'
        ];
        $this->post('/post', $params)->assertStatus(302)
        ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The title must be at least 10 characters.');
    }
    public function testUpdateValid(Store $request, $id){

    $post = $this->createDummyBlogPost()

    $this->assertDatabaseHas('blog_posts', $post->toArray());
    $params = [
        'title'=> 'A new named title',
        'content'=> 'Content was changed'
    ];
    $this->put("/posts/{$post->id}", $params)->assertStatus(302)
    ->assertSessionHas('status');

    $this->assertEquals(session('status'),'Blog post was updated!');

    $this->assertDatabaseMissing('blog_posts', $post->toArray());

    $this->assertDatabaseHas('blog_posts', [
        'title'=> 'A new named title',
    ]);
    }
    public function testDelete() {
        $post = $this->createDummyBlogPost()
        $this->assertDatabaseHas('blog_posts', $post->toArray());
        $this->delete("/posts/{$post->id}")
        ->assertStatus(302)
        ->assertSessionHas('status');

        $this->assertEquals(session('status'),'Blog post was deleted!');



        $this->assertDatabaseMissing('blog_posts', $post->toArray());
    }
    private function createDummyBlogPost() :BlogPost{
        $post = new BlogPost();
        $post -> title = 'New title';
        $post ->content = 'Content of the blog post';
        $post->save();
    }
    }
