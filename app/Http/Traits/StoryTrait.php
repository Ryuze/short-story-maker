<?php
namespace App\Http\Traits;
use Orhanerday\OpenAi\OpenAi;

trait StoryTrait {
    // TODO: perlu referensi buat bikin generate post, ntar lempat ke single page inertia vue. pke api dari https://beta.openai.com/docs/api-reference aja dri pada pke library sampah kurang banyak fitur ini
    public function test() {
        $open_ai = new OpenAi(env('OPEN_AI_API_KEY'));

        dd($open_ai);

        $complete = $open_ai->complete([
            'engine' => 'davinci',
            'prompt' => "give me three paragraph of story about rabbit and cyberpunk",
            'temperature' => 0.9,
            "max_tokens" => 150,
            "frequency_penalty" => 0,
            "presence_penalty" => 0.6,
        ]);

        return $complete;
    }

    public function curlTest() {
        // TODO: mending fokus bikin app referensi cerita aja, ada pilihan kek mau bikin cerita kek gimana, siapa tokohnya, dll
        $ch = curl_init();
        $header = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . env('OPEN_AI_API_KEY'),
        );
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/engines/text-davinci-001/completions');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $post = [
            'prompt' => 'make a cyberpunk story with 4 to 10 character with happy ending but 2 of the character died in battle',
            'max_tokens' => 1597,
            'temperature' => 0.79,
        ];
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}