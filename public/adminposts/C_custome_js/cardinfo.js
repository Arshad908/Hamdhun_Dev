class CardCPlCk{

	constructor(twin_key,card_info){
		this.twinKey = twin_key;
		this.card_info = card_info;

	}

	createCardInfoSend(){
		
		 let cInfo = this.card_info;
		// let masterCat = $.trim(mct);
		
		// if( this.proces_name == "make_card_data_save_process"){
			let data = [];
			
			if (cInfo.length > 0) {
					for (var i = 0; i < cInfo.length; i++) {

			 			let encrypted = CryptoJS.AES.encrypt(cInfo[i], this.twinKey , {format: CryptoJSAesJson}).toString();				
						data[i] = encrypted;
								
					}

			}
		    
			
			return data;
		
//		}

	}
	

}	