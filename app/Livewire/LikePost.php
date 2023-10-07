<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likes;

    public function mount($post){
        $this->isLiked = $post->checkLike( auth()->user());
        $this->isLiked;
        $this->likes = $post->likes->count();
    }

    public function like(){
        if($this->post->checkLike( auth()->user())){
            $this->post->likes()->where('post_id',$this->post->id)->delete();
        }else{
            $this->post->likes()->create([
                'user_id'=>auth()->user()->id
            ]);
        }

        $this->isLiked = $this->post->checkLike( auth()->user());
        $this->likes = $this->post->likes->count();

    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
