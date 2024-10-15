this.onmessage = e =>{
    try{
        if(e.data.status)
            {
                let pegawai = e.data.pegawai
                let inputan = e.data.inputan
                let template = e.data.template

                let baik = 0;
                let rusak_ringan = 0;
                let rusak_sedang = 0;
                let rusak_berat = 0;

                let pmax = pegawai.length
                let pnow = 1

                pegawai.forEach( p=>
                 {

                    this.postMessage({
                        'status' : 'process',
                        'message' : 'Menghitung kondisi APD '+pnow+' dari '+pmax+' Pegawai . . .'
                    })

                    let jabatan = p.jabatan
                    let id = p.id
                    let pt = template[template.findIndex(item => {
                            return item.jabatan == jabatan
                        })].template
                    


                    pt.forEach(t=>{

                        let i = inputan[inputan.findIndex(item =>{
                            if(id == item.pegawai  && item.jenis == t.id_jenis)
                            {
                                if(typeof t.index_duplikat !== "undefined")
                                {
                                    if(t.index_duplikat == item.index_duplikat)
                                        return true;
                                }
                                else
                                {
                                    return true;
                                }
                            }
                            return false;
                        })]


                        if(typeof i !== "undefined")
                        {
                            switch(i.kondisi)
                            {
                                case "baik": baik++;break;
                                case "rusak ringan": rusak_ringan++;break;
                                case "rusak sedang": rusak_sedang++;break;
                                case "rusak berat": rusak_berat++;break;
                                default : break;
                            }
                        }

                        
                    })
                    pnow++
                });
    
                let data = {
                    'status' : 'success',
                    'baik' : baik,
                    'rusak_ringan' : rusak_ringan,
                    'rusak_sedang' : rusak_sedang,
                    'rusak_berat' : rusak_berat,
                }
                this.postMessage(data);
            }
            else
            {
                this.postMessage({
                    'status' : false,
                    'message' : 'Terjadi kesalahan saat mengambil data dari server'
            })
            }

    }
    catch(e)
        {
            console.log('terjadi kesalahan saat penghitungan : '+e)
            this.postMessage({
                'status' : false,
                'message' : 'Terjadi kesalahan saat proses kalkulasi'
            })
        }
    
}