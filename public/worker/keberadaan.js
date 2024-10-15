this.onmessage = e =>{
    try{
        if(e.data.status)
            {
                let pegawai = e.data.pegawai
                let inputan = e.data.inputan
                let template = e.data.template

                let ada = 0;
                let belum = 0;
                let hilang = 0;

                let pmax = pegawai.length
                let pnow = 1

                pegawai.forEach( p=>
                 {

                    this.postMessage({
                        'status' : 'process',
                        'message' : 'Menghitung keberadaan APD '+pnow+' dari '+pmax+' Pegawai . . .'
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
                                case "Hilang": hilang++;break;
                                case "Belum Terima": belum++;break;
                                default : ada++;break;
                            }
                        }

                        
                    })
                    pnow++
                });
    
                let data = {
                    'status' : 'success',
                    'ada' : ada,
                    'belum' : belum,
                    'hilang' : hilang,

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