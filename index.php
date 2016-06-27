<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include 'autoload.php';
   /*     $skilldao = new \worker\SkillLevelDao;
        $skill = new worker\Skill('java');
        $skillLevel = new \worker\SkillLevel($skill, '-1');
        $skilldao->add($skillLevel);
        
     //   $skills = $skilldao->delete(2);
     //   $skills = $skilldao->getByCriteria('name!=?', 'g');
        echo "<pre>";
        print_r($skillLevel);
        echo "</pre>";
     */
        $graph = util\RootNode::getInstance();
        
        $node1 = new \util\Node(1);
        $node2 = new \util\Node(2);
        $node3 = new \util\Node(3);
        $node1->addChild($node2);
        $node1->addChild($node3);
  
        echo ("Node count is " . \util\Node::getNodeCount());
        echo "<pre>";
        print_r($graph);
        echo "------------------------------------------------------------------------------------------------------------";
        print_r($node1);
        echo "------------------------------------------------------------------------------------------------------------";
        print_r($node2);
        echo "</pre>";
        ?>
    </body>
</html>
