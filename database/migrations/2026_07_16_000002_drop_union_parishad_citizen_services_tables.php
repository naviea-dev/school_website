<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $tables = [
        'birth_certificates',
        'certificates',
        'certificate_character',
        'certificate_childless',
        'certificate_citizens',
        'certificate_communities',
        'certificate_dgf_cards',
        'certificate_disabilities',
        'certificate_heirships',
        'certificate_landless',
        'certificate_marriage',
        'certificate_nationalities',
        'certificate_no_objections',
        'certificate_orphan',
        'certificate_permanent_resident',
        'certificate_prottoyon_pattro',
        'certificate_trade_license',
        'certificate_unmarried',
        'holding_tax',
        'house_types',
        'budget_years',
        'taxes',
        'receipts',
        'shop_information',
        'union_information',
        'documents',
        'usefulllinks',
        'transactions',
    ];

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        foreach ($this->tables as $table) {
            Schema::dropIfExists($table);
        }
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        // Not reversible: this drops the old union-parishad citizen-services
        // module (certificates, holding tax, shop info, receipts, union
        // resident registry) as part of repurposing demo-school into a
        // school-only landing page. Restore from a DB backup if needed.
    }
};
