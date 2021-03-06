var Experigen =  {
	settings: {

        // SETUP: Enter Experiment Name
		experimentName: "RusNumberHEBList1", // use only A-Z, a-z, 0-9
		
		databaseServer: "http://db.phonologist.org/",

		online: true,
		
		strings: {
		    // SETUP: Enter Title for Browser Window
			windowTitle:     "Experiment",
			connecting:	"...מתחבר",
			loading:         "... טוענים נתונים",
			soundButton:     "    ►    ",
			continueButton:  "   .המשך   ",
			errorMessage:    ".שגיאה בלתי צפויה. מצטערים על אי הנוחות",
			emptyBoxMessage: ".נא למלא את הטופס הזה"
		},
		
		audio: true,
		
		recordResponseTimes: true,
		
		progressbar: {
			visible: true, 
			adjustWidth: 6,
			percentage: false
		},
		
		items: "resources/index.txt",
		
		otherresources: {	
		},

		folders: {
			views: "views/",
			sounds: "resources/sounds/",
			pictures: "resources/pictures/"
		},
	
		footer: "views/footer.html",
		missingview: "views/missingview.ejs"
	}	
};


