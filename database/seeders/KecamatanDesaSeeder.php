<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KecamatanDesa;
use App\Models\Desa;

class KecamatanDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

// ['010','KENCONG'],
// ['020','GUMUKMAS'],
// ['030','PUGER'],
// ['040','WULUHAN'],
// ['050','AMBULU'],
// ['060','TEMPUREJO'],
// ['070','SILO'],
// ['080','MAYANG'],
// ['090','MUMBULSARI'],
// ['100','JENGGAWAH'],
// ['110','AJUNG'],
// ['120','RAMBIPUJI'],
// ['130','BALUNG'],
// ['140','UMBULSARI'],
// ['150','SEMBORO'],
// ['160','JOMBANG'],
// ['170','SUMBERBARU'],
// ['180','TANGGUL'],
// ['190','BANGSALSARI'],
// ['200','PANTI'],
// ['210','SUKORAMBI'],
// ['220','ARJASA'],
// ['230','PAKUSARI'],
// ['240','KALISAT'],
// ['250','LEDOKOMBO'],
// ['260','SUMBERJAMBE'],
// ['270','SUKOWONO'],
// ['280','JELBUK'],
// ['710','KALIWATES'],
// ['720','SUMBERSARI'],
// ['730','PATRANG'],

        ['10','PASEBAN'],
        ['10','CAKRU'],
        ['10','KRATON'],
        ['10','WONOREJO'],
        ['10','KENCONG'],
        ['20','KEPANJEN'],
        ['20','MAYANGAN'],
        ['20','MENAMPU'],
        ['20','BAGOREJO'],
        ['20','GUMUKMAS'],
        ['20','PURWOSARI'],
        ['20','TEMBOKREJO'],
        ['20','KARANG REJO'],
        ['30','MOJOMULYO'],
        ['30','MOJOSARI'],
        ['30','PUGER KULON'],
        ['30','PUGER WETAN'],
        ['30','GRENDEN'],
        ['30','MLOKOREJO'],
        ['30','KASIYAN'],
        ['30','KASIYAN TIMUR'],
        ['30','WONOSARI'],
        ['30','JAMBEARUM'],
        ['30','BAGON'],
        ['30','WRINGIN TELU'],
        ['40','LOJEJER'],
        ['40','AMPEL'],
        ['40','TANJUNG REJO'],
        ['40','KESILIR'],
        ['40','DUKUH DEMPOK'],
        ['40','TAMANSARI'],
        ['40','GLUNDENGAN'],
        ['50','SUMBERREJO'],
        ['50','ANDONGSARI'],
        ['50','SABRANG'],
        ['50','AMBULU'],
        ['50','PONTANG'],
        ['50','KARANGANYAR'],
        ['50','TEGALSARI'],
        ['60','ANDONGREJO'],
        ['60','CURAHNONGKO'],
        ['60','SANENREJO'],
        ['60','WONOASRI'],
        ['60','SIDODADI'],
        ['60','PONDOKREJO'],
        ['60','CURAHTAKIR'],
        ['60','TEMPUREJO'],
        ['70','MULYOREJO'],
        ['70','PACE'],
        ['70','HARJOMULYO'],
        ['70','KARANGHARJO'],
        ['70','SILO'],
        ['70','SEMPOLAN'],
        ['70','SUMBERJATI'],
        ['70','GARAHAN'],
        ['70','SIDOMULYO'],
        ['80','SEPUTIH'],
        ['80','SIDOMUKTI'],
        ['80','SUMBER KEJAYAN'],
        ['80','TEGALREJO'],
        ['80','TEGALWARU'],
        ['80','MAYANG'],
        ['80','MRAWAN'],
        ['90','KAWANGREJO'],
        ['90','TAMANSARI'],
        ['90','SUCO'],
        ['90','LAMPEJI'],
        ['90','MUMBULSARI'],
        ['90','LENGKONG'],
        ['90','KARANGKEDAWUNG'],
        ['100','KEMUNINGSARI KIDUL'],
        ['100','KERTONEGORO'],
        ['100','JATISARI'],
        ['100','SRUNI'],
        ['100','CANGKRING'],
        ['100','WONOJATI'],
        ['100','JENGGAWAH'],
        ['100','JATIMULYO'],
        ['110','MANGARAN'],
        ['110','SUKAMAKMUR'],
        ['110','KLOMPANGAN'],
        ['110','PANCAKARYA'],
        ['110','AJUNG'],
        ['110','WIROWONGSO'],
        ['110','ROWO INDAH'],
        ['120','CURAHMALANG'],
        ['120','NOGOSARI'],
        ['120','ROWOTAMTU'],
        ['120','PECORO'],
        ['120','RAMBIPUJI'],
        ['120','KALIWINING'],
        ['120','RAMBIGUNDAM'],
        ['120','GUGUT'],
        ['130','KARANG DUREN'],
        ['130','KARANG SEMANDING'],
        ['130','TUTUL'],
        ['130','BALUNG KULON'],
        ['130','BALUNG KIDUL'],
        ['130','BALUNG LOR'],
        ['130','GUMELAR'],
        ['130','CURAH LELE'],
        ['140','SUKORENO'],
        ['140','GUNUNGSARI'],
        ['140','UMBULSARI'],
        ['140','TANJUNGSARI'],
        ['140','PALERAN'],
        ['140','UMBULREJO'],
        ['140','GADINGREJO'],
        ['140','SIDOREJO'],
        ['140','TEGALWANGI'],
        ['140','MUNDUREJO'],
        ['150','REJO AGUNG'],
        ['150','SEMBORO'],
        ['150','SIDOMEKAR'],
        ['150','SIDOMULYO'],
        ['150','PONDOK JOYO'],
        ['150','PODOK DALEM'],
        ['160','KETING'],
        ['160','JOMBANG'],
        ['160','PADOMASAN'],
        ['160','NGAMPELREJO'],
        ['160','WRINGIN AGUNG'],
        ['160','SARI MULYO'],
        ['170','SUMBER AGUNG'],
        ['170','ROWO TENGAH'],
        ['170','YOSORATI'],
        ['170','PRINGGOWIRAWAN'],
        ['170','KARANG BAYAT'],
        ['170','GELANG'],
        ['170','JATIROTO'],
        ['170','JAMINTORO'],
        ['170','KALIGLAGAH'],
        ['170','JAMBESARI'],
        ['180','TANGGUL KULON'],
        ['180','TANGGUL WETAN'],
        ['180','KLATAKAN'],
        ['180','SELODAKON'],
        ['180','DARUNGAN'],
        ['180','MANGGISAN'],
        ['180','PATEMON'],
        ['180','KRAMAT SUKOHARJO'],
        ['190','KARANGSONO'],
        ['190','SUKOREJO'],
        ['190','PETUNG'],
        ['190','TISNOGAMBAR'],
        ['190','LANGKAP'],
        ['190','BANGALSARI'],
        ['190','GAMBIRONO'],
        ['190','CURAH KALONG'],
        ['190','TUGUSARI'],
        ['190','BANJARSARI'],
        ['190','BADEAN'],
        ['200','KEMUNINGSARI LOR'],
        ['200','GLAGAHWERO'],
        ['200','SERUT'],
        ['200','PANTI'],
        ['200','PAKIS'],
        ['200','SUCI'],
        ['200','KEMIRI'],
        ['210','JUBUNG'],
        ['210','DUKUH MENCEK'],
        ['210','SUKORAMBI'],
        ['210','KARANGPRING'],
        ['210','KELUNGKUNG'],
        ['220','KEMUNING LOR'],
        ['220','DARSONO'],
        ['220','ARJASA'],
        ['220','BITING'],
        ['220','CANDIJATI'],
        ['220','KAMAL'],
        ['230','KERTOSARI'],
        ['230','PAKUSARI'],
        ['230','JATIAN'],
        ['230','SUBO'],
        ['230','SUMBERPINANG'],
        ['230','BEDADUNG'],
        ['230','PATEMON'],
        ['240','GAMBIRAN'],
        ['240','PLALANGAN'],
        ['240','AJUNG'],
        ['240','GLAGAHWERO'],
        ['240','SUMBER JERUK'],
        ['240','GUMUKSARI'],
        ['240','PATEMPURAN'],
        ['240','KALISAT'],
        ['240','SUMBER KETEMPAH'],
        ['240','SUKORENO'],
        ['240','SUMBER KALONG'],
        ['240','SEBANEN'],
        ['250','SUREN'],
        ['250','SUMBER SALAK'],
        ['250','SUMBER BULUS'],
        ['250','SUMBER LESUNG'],
        ['250','LEMBENGAN'],
        ['250','SUMBER ANGET'],
        ['250','LEDOKOMBO'],
        ['250','SLATENG'],
        ['250','SUKOGIDRI'],
        ['250','KARANG PAITON'],
        ['260','RANDU AGUNG'],
        ['260','CUMEDAK'],
        ['260','GUNUNG MALANG'],
        ['260','ROWOSARI'],
        ['260','SUMBER JAMBE'],
        ['260','SUMBER PAKEM'],
        ['260','PLEREYAN'],
        ['260','PRINGGONDANI'],
        ['260','JAMBE ARUM'],
        ['270','SUMBERWARU'],
        ['270','SUKOREJO'],
        ['270','SUKOSARI'],
        ['270','BALET BARU'],
        ['270','SUMBER WRINGIN'],
        ['270','MOJOGENI'],
        ['270','SUKOKERTO'],
        ['270','SUKOWONO'],
        ['270','DAWUHAN MANGLI'],
        ['270','ARJASA'],
        ['270','SUMBERDANTI'],
        ['270','POCANGAN'],
        ['280','PANDUMAN'],
        ['280','JELBUK'],
        ['280','SUKOWIRYO'],
        ['280','SUGER KIDUL'],
        ['280','SUKO JEMBER'],
        ['280','SUCO PENGEPOK'],
        ['710','MANGLI'],
        ['710','SEMPUSARI'],
        ['710','KALIWATES'],
        ['710','TEGAL BESAR'],
        ['710','JEMBER KIDUL'],
        ['710','KEPATIHAN'],
        ['710','KEBON AGUNG'],
        ['720','KERANJINGAN'],
        ['720','WIROLEGI'],
        ['720','KARANGREJO'],
        ['720','KEBONSARI'],
        ['720','SUMBERSARI'],
        ['720','TEGAL GEDE'],
        ['720','ANTIROGO'],
        ['730','GEBANG'],
        ['730','JEMBER LOR'],
        ['730','PATRANG'],
        ['730','BARATAN'],
        ['730','BINTORO'],
        ['730','SLAWU'],
        ['730','JUMERTO'],
        ['730','BANJARSENGON'],
        
        ];

        // foreach ($data as $item) {
        //     KecamatanDesa::create([
        //         'id' => $item[0],
        //         'nama' => $item[1],
        //         // 'desa' => $item[3],
        //     ]);
        // }

        foreach ($data as $item) {
            Desa::create([
                'kecamatan_id' => $item[0],
                'nama' => $item[1],
                // 'desa' => $item[3],
            ]);
        }
    }
}

