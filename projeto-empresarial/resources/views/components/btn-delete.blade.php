<form action="{{ route('user.delete', $user->id) }}" method="POST" class="inline">
    @csrf
    @method("DELETE")
    <button type="submit" class="btn-danger">
        Deletar
    </button>
</form>