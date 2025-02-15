public function update(User $user, Tuition $tuition)
{
    return $user->id === $tuition->tutor_id; // Only the tutor who created it can edit
}

public function delete(User $user, Tuition $tuition)
{
    return $user->id === $tuition->tutor_id; // Only the tutor who created it can delete
}