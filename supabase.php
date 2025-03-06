<?php
class Supabase {
    private $url = "https://hrxcvaqlcjiaanepkpsx.supabase.co";
    private $key = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImhyeGN2YXFsY2ppYWFuZXBrcHN4Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDExNDg1MjQsImV4cCI6MjA1NjcyNDUyNH0.gdWwMqmpj0MBZ1C9y4QKI2sKjTJvEEHdGXjmvDfuxMA";

    public function login($email, $password) {
        $data = json_encode(["email" => $email, "password" => $password]);

        $ch = curl_init("{$this->url}/auth/v1/token?grant_type=password");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "apikey: {$this->key}"
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = json_decode(curl_exec($ch), true);
        curl_close($ch);

        return $response["access_token"] ?? false;
    }
}
?>

