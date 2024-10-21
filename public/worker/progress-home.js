this.onmessage = e =>{
    try{
        if(e.data.data.status)
            {
                let pegawai = e.data.data.pegawai
                let inputan = e.data.data.inputan
                let template = e.data.data.template
                let parameter = e.data.parameter
                let target = e.data.target

                let pegawai2 = pegawai.filter(function(item){
                    if(parameter == 'wilayah')
                        return item.wilayah == target
                    else if(parameter == 'penempatan')
                        return item.penempatan == target
                })


                let max_inputan = 0;
                let max_validasi = 0;
                let curr_inputan = 0;
                let curr_validasi = 0;

                let pnow = 1;
                let pmax = pegawai2.length

                pegawai2.forEach( p=>
                 {

                    this.postMessage({
                        'status' : 'process',
                        'message' : ', menghitung capaian input '+pnow+' dari '+pmax+' Pegawai . . .'
                    })

                    let jabatan = p.jabatan
                    let id = p.id
                    let pt = template[template.findIndex(item => {
                            return item.jabatan == jabatan
                        })].template
                    
                    max_inputan = max_inputan + pt.length
                    max_validasi = max_inputan

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
                    'inputan' : (max_inputan > 0 && curr_inputan > 0)? Math.round(Number(curr_inputan/max_inputan) * 100) : 0,
                    'validasi' : (max_validasi > 0 && curr_validasi > 0)? Math.round(Number(curr_validasi/max_validasi) * 100) : 0,
                }
                this.postMessage(data);
            }
            else
            {
                this.postMessage({
                    'status' : 'fail',
                    'message' : 'Terjadi kesalahan saat mengambil data dari server'
            })
            }

    }
    catch(e)
        {
            console.log('terjadi kesalahan saat penghitungan : '+e)
            this.postMessage({
                'status' : 'fail',
                'message' : 'Terjadi kesalahan saat proses kalkulasi'
            })
        }
    
}