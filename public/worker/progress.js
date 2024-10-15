this.onmessage = e =>{
    try{
        if(e.data.status)
            {
                let pegawai = e.data.pegawai
                let inputan = e.data.inputan
                let template = e.data.template

                let max_inputan = 0;
                let curr_inputan = 0;
                let curr_validasi = 0;

                let pmax = pegawai.length
                let pnow = 1

                pegawai.forEach( p=>
                 {
                    this.postMessage({
                        'status' : 'process',
                        'message' : 'Menghitung capaian input '+pnow+' dari '+pmax+' Pegawai . . .'
                    })

                    let jabatan = p.jabatan
                    let id = p.id
                    let pt = template[template.findIndex(item => {
                            return item.jabatan == jabatan
                        })].template
                    
                    max_inputan = max_inputan + pt.length


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
                            curr_inputan++

                            if(i.verifikasi == 3)
                                curr_validasi++
                        }

                        
                    })

                    pnow++
                    
                });
    
                let data = {
                    'status' : 'success',
                    'max_inputan' : max_inputan,
                    'max_validasi' : max_inputan,
                    'curr_inputan' : curr_inputan,
                    'curr_validasi' :  curr_validasi,
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