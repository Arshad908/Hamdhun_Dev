class Category{

	constructor(twin_key,masterCategory,subflaveorCategory){
		this.twinKey = twin_key;
		this.mCategory = masterCategory;
		this.sCategory = subflaveorCategory; 
	}

	createMasterCategory(){
		
		let mct = this.mCategory;
		let masterCat = $.trim(mct);
		
		if(masterCat != "negative"){
		
		    let encrypted = CryptoJS.AES.encrypt(JSON.stringify(masterCat), this.twinKey , {format: CryptoJSAesJson}).toString();
			
			return encrypted;
		
		}

	}
	createSubCategory(){
		let sct = this.sCategory;
		let subCat = sct.trim();
		
		if(subCat != "negative"){
		
			let encrypted = CryptoJS.AES.encrypt(JSON.stringify(subCat), this.twinKey , {format: CryptoJSAesJson}).toString();
			
			return encrypted;
		
		}
	}

}	 