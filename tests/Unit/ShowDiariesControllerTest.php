<?php

namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Diary;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\showDiariesController;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
class ShowDiariesControllerTest extends TestCase
{
    
    
   /** @test */
    public function 編集画面が表示されること()
    {
        $diary = factory(Diary::class)->create([
            'title' => '編集対象',
            'contents' => '編集内容'
        ]);
        $response = $this->get("/{$diary->id}/edit");
        $response->assertStatus(200);
        $response->assertViewIs('edit');
        $response->assertViewHas('diary', $diary);
    }
    /** @test */
    public function 日記を更新できること()
    {
        $diary = factory(Diary::class)->create([
            'title' => '元のタイトル',
            'contents' => '元の内容'
        ]);
         $request = Request::create('/', 'post', [
            'id' => $diary->id,
            'title' => '更新後タイトル',
            'contents' => '更新後内容'
         ]);
        $showdiary = new ShowDiariesController();
        $showdiary->update($diary->id,$request);
        $this->assertDatabaseHas('diaries', [
            'id' => $diary->id,
            'title' => '更新後タイトル',
            'contents' => '更新後内容'
        ]);
    }
    public function test_タイトルが空なら日時がセットされる()
    {
        // 1. 事前にレコードを用意
        $diary = factory(Diary::class)->create();

        // 2. テスト用の現在日時をセット
        Carbon::setTestNow('2024-05-01 12:00:00');

        // 3. ポストリクエスト
        $response = $this->post("/{$diary->id}", [
            'title' => '',             // タイトルなしで更新依頼
            'contents' => '新しい内容'
        ]);

        // 4. DBに想定通りの値が入ったか確認
        $this->assertDatabaseHas('diaries', [
            'id' => $diary->id,
            'title' => '2024-05-01 12:00:00',
            'contents' => '新しい内容',
        ]);
        $response->assertRedirect('/'); // リダイレクト先の確認
        
    }
    /** @test */
    public function コンテンツが空だとバリデーションエラーになること()
    {
        $diary = factory(Diary::class)->create();
        $response = $this->from("/{$diary->id}/edit")->post("/{$diary->id}", [
            'title' => 'テストタイトル',
            'contents' => ''
        ]);
        $response->assertRedirect("/{$diary->id}/edit");
        $response->assertSessionHasErrors('contents');
    }
    
    use RefreshDatabase;
    /** @test */
    public function 一覧画面が表示されること()
    {
        
        $diary = factory(Diary::class)->create([
            'title' => 'タイトル1',
            'contents' => '内容1'
        ]);
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('index');
        $response->assertViewHas('diaries');
        $response->assertSee('タイトル1');
    }
    /** @test */
    public function 日記を削除できること()
    {
        Storage::fake(); 
        $diary = factory(Diary::class)->create();
        $response = $this->delete("/{$diary->id}");
        $response->assertRedirect('/');
        $this->assertDatabaseMissing('diaries', ['id' => $diary->id]);
        $this->assertTrue(Storage::disk()->exists('sample.txt'));
    }
    /** @test */
    public function create_画面が表示できる()
    {
        $response = $this->get('/create');
        $response->assertStatus(200)
                 ->assertViewIs('create');
    }

    /** @test */
    public function add_正常に日記が登録できる()
    {
        $response = $this->post('/add', [
            'title' => 'テストタイトル',
            'contents' => 'テスト内容',
        ]);

        // DB確認
        $this->assertDatabaseHas('diaries', [
            'title' => 'テストタイトル',
            'contents' => 'テスト内容',
        ]);

        // リダイレクト先チェック
        $response->assertRedirect('/');
    }

    /** @test */
    public function add_タイトルが空の場合_現在時刻がタイトルに入る()
    {
        Carbon::setTestNow('2024-05-01 12:00:00'); // テスト用現在時刻

        $response = $this->post('/add', [
            'title' => '', // 空でリクエスト
            'contents' => '時刻タイトル内容',
        ]);

        $this->assertDatabaseHas('diaries', [
            'title' => '2024-05-01 12:00:00',
            'contents' => '時刻タイトル内容',
        ]);
        $response->assertRedirect('/');
    }

    /** @test */
    public function add_contentsが空ならバリデーションエラー()
    {
        $response = $this->from('/create')->post('/add', [
            'title' => 'タイトル',
            'contents' => '', // ←空にしてバリデーションを引っかける
        ]);

        // バリデーションエラーによりリダイレクトされること
        $response->assertRedirect('/create');
        $response->assertSessionHasErrors(['contents']);
    }
}
