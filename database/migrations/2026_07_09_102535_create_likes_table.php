public function up(): void
{
    Schema::create('likes', function (Blueprint $table) {

        $table->id();

        $table->foreignId('user_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->foreignId('post_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->timestamps();

        $table->unique(['user_id','post_id']);

    });
}
