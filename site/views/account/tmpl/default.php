<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die();
$layoutUL 		= new JLayoutFile('user_login', null, array('component' => 'com_phocacart'));
$layoutUR 		= new JLayoutFile('user_register', null, array('component' => 'com_phocacart'));

echo '<div id="ph-pc-account-box" class="pc-account-view'.$this->p->get( 'pageclass_sfx' ).'">';

echo PhocacartRenderFront::renderHeader(array(JText::_('COM_PHOCACART_MY_ACCOUNT')));


/*if ( $this->t['description'] != '') {
	echo '<div class="ph-desc">'. $this->t['description']. '</div>';
}*/

if ((int)$this->u->id > 0) {

	// Reward Points
	if ((int)$this->t['display_reward_points_total_info'] > 0) {
		echo '<div class="'.$this->s['c']['row'].' ph-account-box-row" >';
		echo '<div class="'.$this->s['c']['col.xs12.sm12.md12'].' ph-account-box-header" id="phaccountrewardpoints"><h3>'.JText::_('COM_PHOCACART_REWARD_POINTS').'</h3></div>';
		echo '</div>';

		echo '<div class="'.$this->s['c']['row'].' ph-account-box-action">';

		echo '<div class="'.$this->s['c']['col.xs12.sm8.md8'].'">'. JText::_('COM_PHOCACART_TOTAL_AMOUNT_OF_YOUR_REWARD_POINTS') . ': </div>';
		echo '<div class="'.$this->s['c']['col.xs12.sm4.md4'].'">'.$this->t['rewardpointstotal'].'</div>';

		//echo '<div class="ph-cb"></div>';

		echo '</div>'."\n";// end box action
	}

	// Header
	echo '<div class="'.$this->s['c']['row'].' ph-account-box-row" >';
	echo '<div class="'.$this->s['c']['col.xs12.sm12.md12'].' ph-account-box-header" id="phaccountaddressedit"><h3>'.JText::_('COM_PHOCACART_BILLING_AND_SHIPPING_ADDRESS').'</h3></div>';
	echo '</div>';

	echo '<form action="'.$this->t['linkcheckout'].'" method="post" class="'.$this->s['c']['form-horizontal.form-validate'].'" role="form" id="phcheckoutAddress">';
	echo '<div id="ph-request-message" style="display:none"></div>';

	echo '<div class="'.$this->s['c']['row'].' ph-account-box-action">';

	echo '<div class="'.$this->s['c']['col.xs12.sm6.md6'].' ph-account-billing-row" id="phBillingAddress" >';
	echo '<div class="ph-box-header">'.JText::_('COM_PHOCACART_BILLING_ADDRESS').'</div>';
	echo $this->t['dataaddressform']['b'];
	echo '</div>';// end row

	echo '<div class="'.$this->s['c']['col.xs12.sm6.md6'].' ph-account-shipping-row" id="phShippingAddress" >';
	echo '<div class="ph-box-header">'.JText::_('COM_PHOCACART_SHIPPING_ADDRESS').'</div>';
	echo $this->t['dataaddressform']['s'];
	echo '</div>';// end row

	//echo '<div class="ph-cb"></div>';

	echo '<div class="'.$this->s['c']['col.xs12.sm12.md12'].' '.$this->s['c']['pull-right'].' ph-right ph-account-check-box">';

	if ($this->t['dataaddressform']['s'] != '' && $this->t['$delivery_billing_same_enabled'] != -1) {
		echo '<div class="checkbox">';
		echo '<label><input type="checkbox" id="phCheckoutBillingSameAsShipping" name="phcheckoutbsas" ' . $this->t['dataaddressform']['bsch'] . ' > ' . JText::_('COM_PHOCACART_DELIVERY_AND_BILLING_ADDRESSES_ARE_THE_SAME') . '</label>';
		echo '</div>';
	}

	echo '</div>';

	//echo '<div class="ph-cb"></div>';

	echo '<div class="'.$this->s['c']['col.xs12.sm12.md12'].' '.$this->s['c']['pull-right'].' ph-right ph-account-address-save">';
	echo '<button class="btn btn-primary btn-sm ph-btn"><span class="'.$this->s['i']['save'].'"></span> '.JText::_('COM_PHOCACART_SAVE').'</button>';
	//echo '<input type="submit" value="submit" />';
	echo '</div>';

	//echo '<div class="ph-cb"></div>';
	echo '</div>'."\n";// end box action


	echo '<input type="hidden" name="tmpl" value="component" />';
	echo '<input type="hidden" name="option" value="com_phocacart" />'. "\n";
	echo '<input type="hidden" name="task" value="checkout.saveaddress" />'. "\n";
	echo '<input type="hidden" name="return" value="'.$this->t['actionbase64'].'" />'. "\n";
	echo Joomla\CMS\HTML\HTMLHelper::_('form.token');
	echo '</form>'. "\n";

	if ($this->t['display_edit_profile'] == 1) {
		echo $this->loadTemplate('profile');
	}

} else {

	require_once JPATH_SITE.'/components/com_users/helpers/route.php';
	jimport( 'joomla.application.module.helper' );
	$module = JModuleHelper::getModule('mod_login');
	$mP 	= new JRegistry();
	$mP->loadString($module->params);

	$lang 	= JFactory::getLanguage();
	$lang->load('mod_login');

	echo '<div class="'.$this->s['c']['row'].' ph-account-box-row" >';
	//echo '<div class="ph-account-box-header" id="phaccountloginedit"><div class="ph-pull-right"><span class="'.$this->s['i']['remove-circle'].' ph-account-icon-not-ok"></span></div><h3>1. '.JText::_('COM_PHOCACART_LOGIN_REGISTER').'</h3></div>';
	echo '<div class="'.$this->s['c']['col.xs12.sm12.md12'].' ph-account-box-header" id="phaccountloginedit"><h3>'.JText::_('COM_PHOCACART_LOGIN_REGISTER').'</h3></div>';
	echo '</div>';


	echo '<div class="'.$this->s['c']['row'].' ph-account-box-action">';


	echo '<div class="'.$this->s['c']['col.xs12.sm8.md8'].' ph-right-border">';

	$d = array();
	$d['s'] = $this->s;
	$d['t'] = $this->t;
	echo $layoutUL->render($d);

	echo '</div>'. "\n";// end columns

	echo '<div class="'.$this->s['c']['col.xs12.sm4.md4'].' ph-left-border">';

	$d = array();
	$d['s'] = $this->s;
	$d['t'] = $this->t;
	echo $layoutUR->render($d);

	echo '</div>'. "\n";// end columns

	echo '<div class="ph-cb"></div>';

	echo '</div>'. "\n";// end account box login

	echo '</form>'. "\n";

}


echo '</div>';
echo '<div>&nbsp;</div>';
echo PhocacartUtilsInfo::getInfo();
?>
