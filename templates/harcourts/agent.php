<?php
$agent_has_image = (isset($agent->StaffPhotoUrl) && $agent->StaffPhotoUrl != '/Images/agent-no-image.png') ? true : false;
?>
<div class="agent <?php if ( !$agent_has_image ) echo 'no-image'; ?>">
  <div class="agent-details">
                 <?php
                 $webAgent = is_single() ? false : $this->Listing->findAgentByEmail((string)$agent->EmailAddress);
$agentLink = $webAgent ? get_permalink( $webAgent->ID ) : '';
?>
<h4>
<?php if ( $webAgent ) : ?>
<a href="<?php echo $agentLink; ?>"><?php echo $agent->DisplayName; ?></a>
<?php else: ?>
<?php echo $agent->DisplayName; ?>
<?php endif; ?>
    </h4>
    <?php if ( $agent_has_image ): ?>
      <div class="agent-image">
           <?php if ( $webAgent ) echo "<a href='{$agentLink}'>"; ?>
        <img src="<?php echo $agent->StaffPhotoUrl; ?>">
           <?php if ( $webAgent )echo '</a>'; ?>
      </div>
    <?php endif; ?>
    <p class="numbers">
      <?php foreach ( array('MobileNumber', 'HomeNumber') as $number ): ?>
        <?php if (!empty( $agent->{$number} )): ?>
          <a href="tel:<?php echo $agent->{$number}; ?>"><?php echo $agent->{$number}; ?></a>
        <?php endif; ?>
      <?php endforeach; ?>
    </p>

    <p class="email">
      <a href="mailto:<?php echo $agent->EmailAddress; ?>"><?php echo $agent->EmailAddress; ?></a>
    </p>
    <p class="address">
      <?php echo apply_filters('the_content',$agent->OfficeAddress); ?>
    </p>
  </div>
</div>
