<?php

namespace App\Repositories\Eloquent;

use App\Models\Tag;
use App\Models\User;
use Src\Adapters\Repositories\TagRepository\TagRepositoryInterface;
use Src\Domain\Entities\Tag as TagEntity;
use Src\Domain\Exceptions\EntityNotFoundException;
use Src\Domain\ValueObjects\Uuid;

class TagEloquentRepository implements TagRepositoryInterface
{
    public function findByUserId(int $userId): array
    {
        if (!User::find($userId)) {
            throw new EntityNotFoundException('User not found');
        }

        $tags = Tag::where('user_id', $userId)->orWhereNull('user_id')->get();

        return $tags->map(fn (Tag $tag) => $this->hydrateEntity($tag))->toArray();
    }

    private function hydrateEntity(Tag $tag): TagEntity
    {
        return new TagEntity(
            id: $tag->id,
            uuid: new Uuid($tag->uuid),
            name: $tag->name,
            color: $tag->color
        );
    }
}
