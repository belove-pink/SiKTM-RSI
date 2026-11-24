public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('nim', 15)->nullable()->unique()->after('name');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('nim');
    });
}