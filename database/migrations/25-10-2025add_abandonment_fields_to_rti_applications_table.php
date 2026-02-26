use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('rti_applications', function (Blueprint $table) {
            // Adds a timestamp for when the application was abandoned (left at payment screen)
            $table->timestamp('abandoned_at')->nullable()->after('payment_status');
            
            // Tracks when the recovery email was sent to prevent sending multiple emails
            $table->timestamp('reminder_sent_at')->nullable()->after('abandoned_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rti_applications', function (Blueprint $table) {
            $table->dropColumn('abandoned_at');
            $table->dropColumn('reminder_sent_at');
        });
    }
};