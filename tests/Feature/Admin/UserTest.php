<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     *  未ログインユーザーは管理者側の会員一覧ページにアクセスできないかのテスト
     * 
     * @return void
     */
    public function test_guest_user_cannot_access_admin_users_index_page()
    {

        // 未ログインでアクセス
        $response = $this->get(route('admin.users.index'));

        // 302リダイレクト（ログインページへ）を期待
        $response->assertStatus(302); $response->assertRedirect(route('admin.login'));
    }

    /**
     * ログイン済みの一般ユーザーは管理者側の会員一覧ページにアクセスできないかのテスト
     * 
     * @return void
     */

     public function test_logged_in_user_cannot_access_admin_users_index_page()
     {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.users.index'));

        $response->assertRedirect(route('admin.login'));
     }

     /**
      * ログイン済みの管理者は管理者側の会員一覧ページにアクセスできるかのテスト
      *
      * @return void
      */
      public function test_logged_in_admin_can_access_admin_users_index_page()
      {
        // 管理者でログイン
        $admin = new Admin();
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('nagoyameshi');
        $admin->save();
        $this->actingAs($admin, 'admin');

        // 管理者として会員一覧ページにアクセス
        $response = $this->get(route('admin.users.index'));

        // 200 OKを期待
        $response->assertStatus(200);
      }

      /**
       * 未ログインユーザーは管理者側の会員詳細ページにアクセスできないかのテスト
       * 
       * @return void
       */
      public function test_guest_user_cannot_access_admin_users_show_page()
      {
        // ユーザーを作成
        $user = User::factory()->create();

        // 未ログインで詳細ページにアクセス
        $response = $this->get(route('admin.users.show',$user));

        // 302リダイレクト（ログインページ）へ期待
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.login'));
      }

      /**
       * ログイン済みの一般ユーザーは管理者側の会員詳細ページにアクセスできないかのテスト
       * 
       * @return void
       */

       public function test_logged_in_user_cannot_access_admin_users_show_page()
       {
       $user = User::factory()->create();

       $response = $this->actingAs($user)->get(route('admin.users.show', $user));

       $response->assertRedirect(route('admin.login'));
       }

       /**
        * ログイン済みの管理者は管理者側の会員詳細ページにアクセスできるかのテスト
        * @return void
        */
    public function test_logged_in_admin_can_access_admin_users_show_page()
    {
        // 管理者でログイン
        $admin = User::factory()->create(['is_admin' => true]);  // 管理者を作成
        $this->actingAs($admin, 'admin');

        // ユーザーを作成
        $user = User::factory()->create();

        // 管理者として会員詳細ページにアクセス
        $response = $this->get(route('admin.users.show', $user));

        // 200 OK を期待
        $response->assertStatus(200);
    }
}