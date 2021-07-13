<?php

namespace App\TokenStore;
use App\Models\TokenStore;
use Illuminate\Support\Facades\Auth;

class TokenCache {
  public function storeTokens($access_token, $refresh_token, $expires,$userId) {
    $tokenStore = new TokenStore;
    $tokenStore->access_token;
    $tokenStore->access_token = $access_token;
    $tokenStore->refresh_token = $refresh_token;
    $tokenStore->token_expires = $expires;
    $tokenStore->user_id=$userId;
    $tokenStore->save();
  }

  // public function clearTokens($userId) {
  //   $tokenStore = TokenStore::where('id_user','=',$userId);
  //   $tokenStore->delete();
  //   unset($_SESSION['oauth_state']);
  // }

  public function getAccessToken() {
    // Check if tokens exist
    $userId =Auth::user()->id;
    $tokenStore = TokenStore::where('user_id','=',$userId)->get();
    if (empty($tokenStore[0]->access_token) ||
        empty($tokenStore[0]->refresh_token) ||
        empty($tokenStore[0]->token_expires)) {
      return '';
    }
    // Check if token is expired
    //Get current time + 5 minutes (to allow for time differences)
    $now = time()+300 ;
    if ($tokenStore[0]->token_expires <= $now) {
      // Token is expired (or very close to it)
      // so let's refresh
      foreach($tokenStore as $token){
        $token->delete();
      }
      // Initialize the OAuth client
      $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
        'clientId'                => env('OAUTH_APP_ID'),
        'clientSecret'            => env('OAUTH_APP_PASSWORD'),
        'redirectUri'             => env('OAUTH_REDIRECT_URI'),
        'urlAuthorize'            => env('OAUTH_AUTHORITY').env('OAUTH_AUTHORIZE_ENDPOINT'),
        'urlAccessToken'          => env('OAUTH_AUTHORITY').env('OAUTH_TOKEN_ENDPOINT'),
        'urlResourceOwnerDetails' => '',
        'scopes'                  => env('OAUTH_SCOPES')
      ]);

      try {
        $newToken = $oauthClient->getAccessToken('refresh_token', [
          'refresh_token' => $tokenStore[0]->refresh_token
        ]);

        // Store the new values
        $this->storeTokens($newToken->getToken(), $newToken->getRefreshToken(), 
          $newToken->getExpires(),$userId);

        return $newToken->getToken();
      }
      catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        return '';
      }
    }
    else {
      // Token is still valid, just return it
      return $tokenStore[0]->access_token;
    }
  }
}