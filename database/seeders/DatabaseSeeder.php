<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(NavigationSeeder::class);
        $this->call(AboutusSeeder::class);
        // $this->call(MenuSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(BranchSeeder::class);
        // $this->call(SupplierSeeder::class);
        // $this->call(BrandSeeder::class);
        // $this->call(ProductUnitSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(TestimonialSeeder::class);
        $this->call(OurTeamSeeder::class);
        $this->call(OurClientSeeder::class);
        $this->call(WhyChoseUsSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(PackageDetailsSeeder::class);

        // $this->call(ExpenseCategorySeeder::class);
        // // $this->call(ExpenseCategory::class);
        // $this->call(UserSeeder::class);
        // $this->call(BrandSeeder::class);
        // $this->call(BankSeeder::class);
        // // $this->call(CompanySetupSeeder::class);
        // $this->call(CurrencySeeder::class);
        // $this->call(FormSeeder::class);
        // $this->call(GeneralSetupSeeder::class);
        // $this->call(LanguageSeeder::class);
        // $this->call(ProductUnitSeeder::class);
        // $this->call(AllVoucherSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(ChartOfAccountSeeder::class);
        // $this->call(CustomerSeeder::class);
        // $this->call(EmployeeSeeder::class);
        // $this->call(FiscalYearSeeder::class);
        // $this->call(GeneralLedgerSeeder::class);
        // $this->call(GeneralSeeder::class);
        // $this->call(InvoiceDetailsSeeder::class);
        // $this->call(OpeningSeeder::class);
        // $this->call(ProductSeeder::class);
        // $this->call(PurchasesDetailsSeeder::class);
        // $this->call(StockSeeder::class);
        // $this->call(StoreSeeder::class);
        // $this->call(TransferDetailsSeeder::class);
        // $this->call(TranspferSeeder::class);
        // $this->call(UserManageSeeder::class);
        // $this->call(CustomerSeeder::class);
        // $this->call(InoviceSeeder::class);
        // $this->call(PurchasesSeeder::class);
        // $this->call(SmtpSeeder::class);
        // $this->call(DistrictSeeder::class);
        // $this->call(DivisionSeeder::class);
        // $this->call(UnionSeeder::class);
        // $this->call(UpazilaSeeder::class);
        // $this->call(NavigationSeeder::class);
        // $this->call(AdminRoleSeeder::class);

        // $this->call(SmtpSeeder::class);

        // \App\Models\User::factory(10)->create();
    }
}
