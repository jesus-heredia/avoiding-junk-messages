/**
 * Checks to see if a field was left blank.
 * @param field
 *   The field to be evaluated.
 * @return 
 *   Returns TRUE if the field was left blank.
 */
function isItBlank(field) {

  if (field == null || field == '') {

    return true;

  }

}

/**
 * Checks to see if the format for the email field is valid.
 * @param email
 *   The email address to be evaluated.
 * @return 
 *   Returns TRUE if the format for the email address is correct.
 */
function checkEmail(email) {

  filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

  if (filter.test(email.value)) {

    return true;

  } else {

    return false;

  }

}

/**
 * Checks to see if all the fields have been filled out properly:
 *   - There is no field in blank.
 *   - The format for the email field is valid.
 * @return
 *   Returns FALSE if there was an error.
 */
function validateForm() {

  var my_form = document.forms['contact_form'];

  var required_fields = new Array('name', 'email', 'subject', 'message');

  var email = document.forms['contact_form'][1];

  var x;

  /**
   * This piece of code goes through the contact form to check if there is no
   * field in blank. If the vistor left any field in blank, then an alert message
   * will be displayed and FALSE returned.
   */

  for (x in required_fields) {

    if (isItBlank(my_form[required_fields[x]].value)) {

      my_form[required_fields[x]].focus();
			
      alert('The ' + required_fields[x] + ' field has been left blank.');

			return false;

		}

  }

  /**
   * Checks to see if the format for the email address is valid. If it's
   * not, then, an alert message will be displayed and FALSE returned.
   */
  if (!checkEmail(email)) {

    email.focus();
			
    alert('The email field is not valid.');

    return false;
 
  }

}
