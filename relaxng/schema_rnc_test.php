<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
//Assembler of RNC schema for RuleML 1.01
//
//Step 0000. Extract all GET parameters
$backbone = "backbone";
$backbone_andor = 0;
$backbone_implies = 1;
$backbone_quant = 2;
$backbone_expr = 3;
$backbone_dis = 4;
$backbone_fo = 5;
$bbackbone = processGETParameter ($backbone);
$backboneParam = "x".dechex(bindec($bbackbone));
//
$default = "default";
$default_absent = 0;
$default_present = 1;
$default_absent_fo = 2;
$bdefault = processGETParameter ($default);
$defaultParam = "x".dechex(bindec($bdefault));
//
$termseq = "termseq";
$termseq_unary = 0;
$termseq_binary = 1;
$termseq_ternary_plus = 2;
$btermseq = processGETParameter ($termseq);
$termseqParam = "x".dechex(bindec($btermseq));
//
$lng = "lng";
$lng_abbrev_en = 0;
$lng_long_en = 1;
//$lng_long_fr = 2;
$blng = processGETParameter ($lng);
$lngParam = "x".dechex(bindec($blng));
//
$propo = "propo";
$propo_iri = 0;
$propo_rulebase = 1;
$propo_entails = 2;
$propo_degree = 3;
$propo_neg = 4;
$propo_naf = 5;
$propo_node = 6;
$propo_meta = 7;
$propo_xmlbase = 8;
$propo_xmlid = 9;
$bpropo = processGETParameter ($propo);
$propoParam = "x".dechex(bindec($bpropo));
//
$implies = "implies";
$implies_equivalent = 0;
$implies_direction = 1;
$implies_material = 2;
$implies_and = 3;
$implies_nc = 4;
$implies_or = 5;
$implies_ex = 6;
$bimplies = processGETParameter ($implies);
$impliesParam = "x".dechex(bindec($bimplies));
//
$terms = "terms";
$terms_oid = 0;
$terms_slot = 1;
$terms_card = 2;
$terms_weight = 3;
$terms_equal = 4;
$terms_oriented = 5;
$terms_type = 8;
$terms_data = 9;
$terms_skolem = 10;
$terms_reify = 11;
$terms_var = 12;
$bterms = processGETParameter ($terms);
$termsParam = "x".dechex(bindec($bterms));
//
$quant = "quant";
$quant_closure = 0;
$quant_resl = 1;
$quant_repo = 2;
$bquant = processGETParameter ($quant);
$quantParam = "x".dechex(bindec($bquant));
//
$expr = "expr";
$expr_val_absent = 0;
$expr_plex = 1;
$expr_val_nondefault = 2;
$expr_in = 3;
$bexpr = processGETParameter ($expr);
$exprParam = "x".dechex(bindec($bexpr));
//
$serialization = "serial";
$serialization_unordered = 0;
$serialization_stripeskip = 1;
$serialization_datatyping = 2;
$serialization_schemaLocation = 3;
$serialization_pivot = 4;
$serialization_absolute = 5;
$bserialization = processGETParameter ($serialization);
$serializationParam = "x".dechex(bindec($bserialization));

// Step 000. Initialize some parameters
header('Content-Description: File Transfer');
header('Content-type: application/relax-ng-compact-syntax; charset=utf-8');
$rnc_filename = 'myng';
$rnc_filename = $rnc_filename.'-b'.substr($backboneParam, 1);
$rnc_filename = $rnc_filename.'-d'.substr($defaultParam, 1);
$rnc_filename = $rnc_filename.'-a'.substr($termseqParam, 1);
$rnc_filename = $rnc_filename.'-l'.substr($lngParam, 1);
$rnc_filename = $rnc_filename.'-p'.substr($propoParam, 1);
$rnc_filename = $rnc_filename.'-i'.substr($impliesParam, 1);
$rnc_filename = $rnc_filename.'-t'.substr($termsParam, 1);
$rnc_filename = $rnc_filename.'-q'.substr($quantParam, 1);
$rnc_filename = $rnc_filename.'-e'.substr($exprParam, 1);
$rnc_filename = $rnc_filename.'-s'.substr($serializationParam, 1);
$rnc_filename = $rnc_filename.'.rnc';
header('Content-Disposition: attachment; filename="'.basename($rnc_filename).'"');
$start = ' start = Node.choice | edge.choice'."\n";
$end = ' inherit = ruleml {start |= notAllowed}';
$base_url = "http://deliberation.ruleml.org/1.01/relaxng/schema_rnc.php";
$now =  date(DATE_ATOM,time());

//
// Step 00. Document the GET parameters and construct the URL
$this_url = $base_url;
$this_url = $this_url . "?";
$call_fragment = $backbone."=".$backboneParam;
echo "# GET parameter: ".$call_fragment."\n";
$this_url = $this_url . $call_fragment."&";
$call_fragment = $default."=".$defaultParam;
echo "# GET parameter: ".$call_fragment."\n";
$this_url = $this_url . $call_fragment."&";
$call_fragment = $termseq."=".$termseqParam;
echo "# GET parameter: ".$call_fragment."\n";
$this_url = $this_url . $call_fragment."&";
$call_fragment = $lng."=".$lngParam;
echo "# GET parameter: ".$call_fragment."\n";
$this_url = $this_url . $call_fragment."&";
$call_fragment = $propo."=".$propoParam;
echo "# GET parameter: ".$call_fragment."\n";
$this_url = $this_url . $call_fragment."&";
$call_fragment = $implies."=".$impliesParam;
echo "# GET parameter: ".$call_fragment."\n";
$this_url = $this_url . $call_fragment."&";
$call_fragment = $terms."=".$termsParam;
echo "# GET parameter: ".$call_fragment."\n";
$this_url = $this_url . $call_fragment."&";
$call_fragment = $quant."=".$quantParam;
echo "# GET parameter: ".$call_fragment."\n";
$this_url = $this_url . $call_fragment."&";
$call_fragment = $expr."=".$exprParam;
echo "# GET parameter: ".$call_fragment."\n";
$this_url = $this_url . $call_fragment."&";
$call_fragment = $serialization."=".$serializationParam;
echo "# GET parameter: ".$call_fragment."\n";
$this_url = $this_url . $call_fragment;



//Step 00. Write the header
echo 'namespace dc = "http://purl.org/dc/elements/1.1/"'."\n";
echo 'namespace dcterms = "http://purl.org/dc/terms/"'."\n";
echo 'namespace ruleml = "http://ruleml.org/spec"'."\n";
echo "\n";
echo 'dc:title [ "Deliberation RuleML Custom-Built Schema" ]'."\n";
echo 'dc:version [ "1.01" ]'."\n";
echo 'dc:creator [ "Tara Athan (taraathan AT gmail.com)" ]'."\n";
echo 'dc:subject [ "Deliberation RuleML, custom-built" ]'."\n";
echo 'dc:description ['."\n";
echo '    "custom-built main module for a Deliberation RuleML sublanguage."'."\n";
echo ']'."\n";
echo 'dc:date [ "';
echo($now);
echo '" ]'."\n";
echo 'dc:language [ "en" ]'."\n";
echo 'dcterms:rights [ "TBD" ]'."\n";
echo 'dc:relation [ "http://deliberation.ruleml.org/1.01" ]'."\n";
echo "# Call parameters\n";
echo "# Base URL = $base_url \n";


echo "# Complete URL = \n";
echo "#     " . $this_url . "\n";
if ($bdefault==0){
    echo "#\n# Error: The ".$default." parameter value ".$defaultParam." is not allowed.\n";
} else {
  
  $needAndOr = extractBit($bbackbone, $backbone_andor);
  $needImp = extractBit($bbackbone, $backbone_implies);
  $needQuant = extractBit($bbackbone, $backbone_quant);
  $needExpr = extractBit($bbackbone, $backbone_expr);
  // Disjunctive Heads are now indicated from the implication options facets.
  // However, we honor the backbone code for dishornlog for backward compatibility
  $needDis = extractBit($bbackbone, $backbone_dis);
  $needFO = extractBit($bbackbone, $backbone_fo);
  
  $needDefaultAbsent = extractBit($bdefault, $default_absent); 
  $bdefault_present = extractBit($bdefault, $default_present);
  $needDefaultAbsentFO = extractBit($bdefault, $default_absent_fo);

  $btermseq_unary = extractBit($btermseq, $termseq_unary);
  $btermseq_binary = extractBit($btermseq, $termseq_binary);
  $btermseq_ternary_plus = extractBit($btermseq, $termseq_ternary_plus);
  $needPoly = $btermseq_ternary_plus * $btermseq_binary * $btermseq_unary;
  
  // Apparent lack of monotonicity caused by incomplete orthogonalization
  // of modules for binary and polyadic positional term sequences.
  // Orthogonalization is possible but awkward, leading to complex and unreadable grammar rules.
  $needBin = $btermseq_binary * (1-$needPoly);
  $needUn  = $btermseq_unary  * (1-$needPoly);
  
  $needLongNames = extractBit($blng, $lng_long_en);

  // Apparent lack of monotonicity caused by incomplete orthogonalization
  // of modules for ordered and unordered groups.
  // Orthogonalization is possible but awkward, leading to complex and unreadable grammar rules.
  $needUnordered = extractBit($bserialization, $serialization_unordered);
  $needOrdered = (1-$needUnordered);
  $needStripeSkip = extractBit($bserialization, $serialization_stripeskip);
  $needDatatyping = extractBit($bserialization, $serialization_datatyping);
  $needSchemaLocation = extractBit($bserialization, $serialization_schemaLocation);
  $notPivot = 1-extractBit($bserialization, $serialization_pivot);
  $absolute = extractBit($bserialization, $serialization_absolute);

  $needURI = extractBit($bpropo, $propo_iri);
  $needRulebase = extractBit($bpropo, $propo_rulebase);
  $needEntails = extractBit($bpropo, $propo_entails);
  $needFuzzy = extractBit($bpropo, $propo_degree);
  $needNeg = extractBit($bpropo, $propo_neg);
  $needNaf = extractBit($bpropo, $propo_naf);
  $needNode = extractBit($bpropo, $propo_node);
  $needMeta = extractBit($bpropo, $propo_meta);
  $needBase = extractBit($bpropo, $propo_xmlbase);
  $needId = extractBit($bpropo, $propo_xmlid);

  $needEquiv = extractBit($bimplies, $implies_equivalent);
  $needDirND =  extractBit($bimplies, $implies_direction);
  $needDirD =  $bdefault_present;
  $needDirAtt = max($needDirD , $needDirND);
  $needMatND =  extractBit($bimplies, $implies_material);
  $needMatD =  $bdefault_present;
  $needMatAtt = max($needMatD , $needMatND);
  //Apparent lack of monotonicity caused by containment of the
  // existential head module within the implementation of FOL.
  //Including the existential head module would be redundant in FOL.
  // Similar considerations hold for negative constraints and
  // conjunctive heads.
  $needExHead = extractBit($bimplies, $implies_ex)*(1-$needFO);
  $needAndHead = extractBit($bimplies, $implies_and)*(1-$needFO);
  $needOrHead = max($needDis , extractBit($bimplies, $implies_or))*(1-$needFO);
  $needNegConstraint = extractBit($bimplies, $implies_nc)*(1-$needDis)*(1-$needOrHead);
  
  $needOid = extractBit($bterms, $terms_oid);
  $needSlot = extractBit($bterms, $terms_slot);
  $needCard = extractBit($bterms, $terms_card);
  $needWeight = extractBit($bterms, $terms_weight);
  $needEqualBi = extractBit($bterms, $terms_equal);
  $needOrientedND = extractBit($bterms, $terms_oriented);
  $needEqual = max($needEqualBi, $needOrientedND);
  $needOrientedAtt = max($needOrientedND, $bdefault_present) * $needEqual;
  $needOrientedD = $bdefault_present * $needEqualBi;
  $needType = extractBit($bterms, $terms_type);
  $needDataTerms = extractBit($bterms, $terms_data);
  $needData = max($needDataTerms , $needFuzzy);
  $needSkolem = extractBit($bterms, $terms_skolem);
  $needReify = extractBit($bterms, $terms_reify);
  $needInd = max($btermseq , $needOid , $needSlot , $needEqual);

  $needVar = max($needQuant , extractBit($bterms, $terms_var));   
  $needClosure = extractBit($bquant, $quant_closure);
  $needResl = extractBit($bquant, $quant_resl);
  $needRepo = extractBit($bquant, $quant_repo);
  
  $needValAbsent = extractBit($bexpr, $expr_val_absent);
  $needPlex = extractBit($bexpr, $expr_plex);
  $needValND = extractBit($bexpr, $expr_val_nondefault);
  $needValD = $bdefault_present * $needExpr * $needEqual;
  $needValAtt = max($needValD , $needValND);
  $needInND = extractBit($bexpr, $expr_in);
  $needInD = $bdefault_present * $needExpr;
  $needInAtt = max($needInD , $needInND);

  $needPerformatives = 1;
  $needAtom = 1;
  $needInit = 1;
  
  $needDefaultPresent =  max($bdefault_present , $needDirND , $needMatND , $needInND , $needValND , $needOrientedND);    
  $needDefaultPresentFO = $needDefaultPresent * $needFO;

  //Step 1. Assemble the language foundation
  if ($absolute) {
    $schemaLocation='http://deliberation.ruleml.org/1.01/relaxng/';  
  } else {
    $schemaLocation='';
  }
  $modulesLocation = $schemaLocation . 'modules/';

  //Step 1A. Assemble the propositional language 
  // Add the start statement
    echo $start;
  // Include the root and performatives if needed
    if ($needPerformatives) {    
      echo "#\n# ROOT NODE AND PERFORMATIVES INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .'performative_expansion_module.rnc"'."$end\n";
    }
  //Step 1B. Assemble the backbone expressivity from expansion modules 
    if ($needAtom){    
      echo "#\n# ATOMIC FORMULAS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
        'atom_expansion_module.rnc"'."$end\n";
    }
    if ($needAndOr){
      echo "#\n# CONJUNCTIONS AND DISJUNCTIONS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'andor_expansion_module.rnc"'."$end\n";
    }
    if ($needImp){
      echo "#\n# IMPLICATIONS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'implication_expansion_module.rnc"'."$end\n";
    }
    if ($needQuant){
      echo "#\n# QUANTIFICATION OVER VARIABLES INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'quantification_expansion_module.rnc"'."$end\n";
    }
    if ($needExpr){
      echo "#\n# EXPRESSIONS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'expr_expansion_module.rnc"'."$end\n";
    }
    if ($needOrHead){
      echo "#\n# DISJUNCTIONS IN CONCLUSIONS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'dis_expansion_module.rnc"'."$end\n";
    }
    if ($needFO){
      echo "#\n# RESTRICTIONS ON COMPOUNDING CLASSICAL FORMULAS REMOVED \n";
      if ($needNeg){
        echo "#   FULL FIRST-ORDER EXPRESSIVITY (INCLUDING NEGATION) IS AVAILABLE \n";
      }
      echo "#\n".'include "' . $modulesLocation .
          'folog_cl_expansion_module.rnc"'."$end\n";
    }

  //Step 1C. Include the appropriate module(s) for default values present
  //         absent, or optional
  echo "#\n# ATTRIBUTES WITH DEFAULT VALUES ARE INITIALIZED\n";
  echo "#\n".'include "' . $modulesLocation .
      'default_inf_expansion_module.rnc"'."$end\n";
  if ($needDefaultAbsent){
    echo "#\n# ATTRIBUTES WITH DEFAULT VALUES ARE ABSENT OR OPTIONAL\n";
    echo "#\n".'include "' . $modulesLocation .
        'default_absent_expansion_module.rnc"'."$end\n";
  }
  if ($needDefaultAbsentFO){
      echo 'include "' . $modulesLocation .
          'default_absent_folog_expansion_module.rnc"'."$end\n";
  } 
  if ($needDefaultPresent) {
      echo "#\n# ATTRIBUTES WITH DEFAULT VALUES REQUIRED\n";
      echo "#\n".'include "' . $modulesLocation .
          'default_present_expansion_module.rnc"'."$end\n";
  }
  if ($needDefaultPresentFO){
          echo 'include "' . $modulesLocation .
              'default_present_folog_expansion_module.rnc"'."$end\n";
  }
  //Step 1D. Determine which module to include for positional arguments 
  if ($needUn){
      echo "#\n# UNARY TERM (ONE TERM ONLY) SEQUENCES INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
        'termseq_un_expansion_module.rnc"'."$end\n";
  }
  if ($needBin){
      echo "#\n# BINARY TERM (TWO TERMS ONLY) SEQUENCES INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
        'termseq_bin_expansion_module.rnc"'."$end\n";
  }
  if ($needPoly){
      echo "#\n# POLYADIC TERM (ONE OR MORE TERMS) SEQUENCES INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'termseq_poly_expansion_module.rnc"'."$end\n";
  }
  //Step 3F. Include serialization modules 
    // DOCUMENTME: apparent violation of monotonicity with else clause
    //       However, ordered groups is contained in unorder groups
    //       so it is redundant.
    // Include unordered groups
    if ($needUnordered){
      echo "#\n# ORDER MODE - UNORDERED GROUPS ENABLED\n";
      echo "#\n".'include "' . $modulesLocation .
          'unordered_groups_expansion_module.rnc"'."$end\n";
    }
    if ($needOrdered){
      echo "#\n# ORDER MODE - UNORDERED GROUPS DISABLED\n";
      echo "#\n".'include "' . $modulesLocation .
          'ordered_groups_expansion_module.rnc"'."$end\n";
    }
    // Include stripe-skipping
    if ($needStripeSkip){
      echo "#\n# SYNCHRONOUS STRIPE-SKIPPING MODE ENABLED\n";
      echo "#\n".'include "' . $modulesLocation .
          'stripe_skipping_expansion_module.rnc"'."$end\n";
      if ($notPivot){ 
      // not included when converting to XSD
      echo "#\n# ASYNCHRONOUS STRIPE-SKIPPING MODE ENABLED\n";
      echo "#\n".'include "' . $modulesLocation .
          'asynchronous_stripe_skipping_entailment_expansion_module.rnc"'."$end\n";
      echo "#\n".'include "' . $modulesLocation .
          'asynchronous_stripe_skipping_implication_expansion_module.rnc"'."$end\n";
      }
    }
    
    // Include explicit datatyping
    if ($needDatatyping){
      echo "#\n# EXPLICIT DATATYPING ENABLED\n";
      echo "#\n".'include "' . $modulesLocation .
          'explicit_datatyping_expansion_module.rnc"'."$end\n";
      echo 'include "' . $modulesLocation .
          'dataterm_simple_expansion_module.rnc"'."$end\n";
      echo 'include "' . $modulesLocation .
          'data_simple_content_expansion_module.rnc"'."$end\n";
    }
    // Include xsi:schemaLocation
  if ($needSchemaLocation){
      echo "#\n# xsi:schemaLocation ALLOWED IN RuleML\n";
      echo "#\n".'include "' . $modulesLocation .
          'xsi_schemalocation_expansion_module.rnc"'."$end\n";
  }
  //Step 4. Mix-in optional expansion modules
  //Step 4A. Include proposition-related modules 
    // Include universal resource identifiers (URIs) if needed
    if ($needURI){
      echo "#\n# UNIVERSAL RESOURCE IDENTIFIERS (URIs) INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'iri_expansion_module.rnc"'."$end\n";
    }
    // Include rulebases if needed
    if ($needRulebase){
      echo "#\n# RULEBASES INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'rulebase_expansion_module.rnc"'."$end\n";
    }
    // Include entailments if needed
    if ($needEntails){
      echo "#\n# ENTAILMENTS (PROVES) INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'metalevel_expansion_module.rnc"'."$end\n";
    }
    // Include degree of uncertainty if needed
    if ($needFuzzy){
      echo "#\n# DEGREE OF UNCERTAINTY INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'fuzzy_expansion_module.rnc"'."$end\n";
    }
    // Include strong negations if needed
    if ($needNeg){
      echo "#\n# STRONG NEGATION INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'neg_expansion_module.rnc"'."$end\n";
    }
    // Include weak negations if needed
    if ($needNaf){
      echo "#\n# WEAK NEGATIONS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'naf_expansion_module.rnc"'."$end\n";
    }
    // Include node identifiers if needed
    if ($needNode){
      echo "#\n# NODE IDENTIFIERS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'node_attribute_expansion_module.rnc"'."$end\n";
    }
    // Include in-place annotations if needed
    if ($needMeta){
      echo "#\n# IN-PLACE ANNOTATIONS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'meta_expansion_module.rnc"'."$end\n";
    }
    // Include XML base attribute if needed
    if ($needBase){
      echo "#\n# XML BASE ATTRIBUTE INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'xml_base_expansion_module.rnc"'."$end\n";
    }
    // Include XML id attribute if needed
    if ($needId){
      echo "#\n# XML ID ATTRIBUTE INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'xml_id_expansion_module.rnc"'."$end\n";
    }
  //Step 4B. Include implication-related modules 
    // Include equivalences
    if ($needEquiv){
      echo "#\n# EQUIVALENCES INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'equivalent_expansion_module.rnc"'."$end\n";
    }
    // Include inference direction attribute if needed
    if ($needDirAtt){
      echo "#\n# INFERENCE DIRECTION ATTRIBUTE IS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'direction_attrib_expansion_module.rnc"'."$end\n";      
    }
    // Include non-symmetric inference direction attribute value if needed
    if ($needDirND){
      echo "#\n# NON-DEFAULT VALUES OF INFERENCE DIRECTION INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
            'direction_non-default_expansion_module.rnc"'."$end\n";
    }
    // Include symmetric inference direction attribute value if needed
    if ($needDirD){
      echo "#\n# DEFAULT VALUES OF INFERENCE DIRECTION INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
        'direction_default_expansion_module.rnc"'."$end\n";
    }
    // Include material implication attributes if needed
    if ($needMatAtt){
      echo "#\n# MATERIAL IMPLICATION ATTRIBUTE IS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'material_attrib_expansion_module.rnc"'."$end\n";      
    }
    // Include non-material implication if needed
    if ($needMatND){
      echo "#\n# NON-DEFAULT VALUES OF MATERIAL IMPLICATION INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
            'material_non-default_expansion_module.rnc"'."$end\n";
    }
    // Include material implication if needed
    if ($needMatD){
      echo "#\n# DEFAULT VALUES OF MATERIAL IMPLICATION INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
        'material_default_expansion_module.rnc"'."$end\n";
    }
    // Include existential heads in implications if needed
    if ($needExHead){
      echo "#\n# EXISTENTIAL HEADS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'existential_head_expansion_module.rnc"'."$end\n";
    }    
    // Include negative constraints if needed
    if ($needNegConstraint){
      echo "#\n# NEGATIVE CONSTRAINTS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'negative_constraint_expansion_module.rnc"'."$end\n";
    }
    // Include conjunctive heads in implications if needed
    if ($needAndHead){
      echo "#\n# CONJUNCTIVE HEADS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'conjunctive_head_expansion_module.rnc"'."$end\n";
    }
    
  //Step 3C. Include term-related modules 
    // Include object identifiers
    if ($needOid){
      echo "#\n# OBJECT IDENTIFIERS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'oid_expansion_module.rnc"'."$end\n";
    }
    // Include slots
    if ($needSlot){
      echo "#\n# SLOTS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'slot_expansion_module.rnc"'."$end\n";
    }
    // Include slot cardinality
    if ($needCard){
      echo "#\n# SLOT CARDINALITY INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'card_expansion_module.rnc"'."$end\n";
    }
    // Include slot weights
    if ($needWeight){
      echo "#\n# SLOT WEIGHTS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'weight_expansion_module.rnc"'."$end\n";
    }
    // Include equations
    if ($needEqual){
      echo "#\n# EQUATIONS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'equal_expansion_module.rnc"'."$end\n";
    }
    // Include oriented equality attribute if needed
    if ($needOrientedAtt){
      echo "#\n# ORIENTED EQUALITY ATTRIBUTE IS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
           'oriented_attrib_expansion_module.rnc"'."$end\n";      
    }
    // Include non-symmetric equality attribute values if needed
    if ($needOrientedND){
      echo "#\n# NON-DEFAULT VALUES OF ORIENTED EQUALITY ATTRIBUTE INCLUDED\n";
        echo "#\n".'include "' . $modulesLocation .
            'oriented_non-default_expansion_module.rnc"'."$end\n";
      }
    // Include symmetric equality attribute values if needed
    if ($needOrientedD){
      echo "#\n# DEFAULT VALUE OF ORIENTED EQUALITY ATTRIBUTE INCLUDED\n";
        echo "#\n".'include "' . $modulesLocation .
          'oriented_default_expansion_module.rnc"'."$end\n";
      }
    // Include explicit typing of terms if needed
    if ($needType){
      echo "#\n# EXPLICIT TYPING OF TERMS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'type_expansion_module.rnc"'."$end\n";
    }
    // Include data terms if needed
    if ($needDataTerms){
      echo "#\n# DATA TERMS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'dataterm_any_expansion_module.rnc"'."$end\n";
    }
    // Include data element if needed 
    // for example, for either terms or degree of uncertainty
    if ($needData){
      echo "#\n# DATA ELEMENTS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'data_any_content_expansion_module.rnc"'."$end\n";
    }
    // Include skolem constants if needed
    if ($needSkolem){
      echo "#\n# SKOLEM CONSTANTS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'skolem_expansion_module.rnc"'."$end\n";
    }
    // Include reified terms if needed
    // DOCUMENTME: apparent violation of monotonicity with else clause
    //             needed for conversion to XSD with process strict
    //             In that case, monotonicity is preserved.
    if ($needReify){
      if ($notPivot){    
        echo "#\n# REIFICATION TERMS INCLUDED, EXPLICIT CONTENT\n";
        echo "#\n".'include "' . $modulesLocation .
            'reify_expansion_module.rnc"'."$end\n";
      } else {
        // just for conversion to XSD
        echo "#\n# REIFICATION TERMS INCLUDED, ANY CONTENT\n";
        echo "#\n".'include "' . $modulesLocation .
            'reify_any_expansion_module.rnc"'."$end\n";      
      }      
    }
    // Include individuals if needed
    if ($needInd){
      echo "#\n# INDIVIDUAL TERMS (INTERPRETED NAMES) ARE INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'individual_expansion_module.rnc"'."$end\n";      
    }
    // Include variables if needed
    if ($needVar){
      echo "#\n# VARIABLES (INTERPRETABLE NAMES) ARE INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'variable_expansion_module.rnc"'."$end\n";      
    }
  //Step 3D. Include quantification-related modules if needed
    // Include implicit closure if needed
    if ($needClosure){
      echo "#\n# IMPLICIT CLOSURE INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'closure_expansion_module.rnc"'."$end\n";
    }
    // Include slotted rest variables if needed
    if ($needResl){
      echo "#\n# SLOTTED REST VARIABLES INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'resl_expansion_module.rnc"'."$end\n";
    }
    // Include positional rest variables if needed
    if ($needRepo){
      echo "#\n# POSITIONAL REST VARIABLES INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'repo_expansion_module.rnc"'."$end\n";
    }
  //Step 3E. Include expression-related modules 
    // Include generalized lists
    if ($needPlex){
      echo "#\n# GENERALIZED LISTS INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'plex_expansion_module.rnc"'."$end\n";
    }

  // Include empty initialization of set-valued attribute if needed
  if ( $needValAbsent ){
      echo "#\n# SET-VALUED EXPRESSION ATTRIBUTE IS ABSENT OR OPTIONAL\n";
      echo "#\n".'include "' . $modulesLocation .
          'val_absence_expansion_module.rnc"'."$end\n";
  }  
  // Include set-valued expression attribute if needed
 if ($needValAtt){
    echo "#\n# SET-VALUED EXPRESSION ATTRIBUTE IS INCLUDED\n";
    echo "#\n".'include "' . $modulesLocation .
        'val_attrib_expansion_module.rnc"'."$end\n";      
  }
  // Include non-default values of set-valued expression attribute if needed
  if ($needValND){
    echo "#\n# NON-DEFAULT VALUES OF THE SET-VALUED ATTRIBUTE INCLUDED\n";
    echo "#\n".'include "' . $modulesLocation .
        'val_non-default_expansion_module.rnc"'."$end\n";
  }
  // Include default values of set-valued expression attribute if needed
  if ($needValD){
    echo "#\n# DEFAULT VALUE OF THE SET-VALUED ATTRIBUTE INCLUDED\n";
    echo "#\n".'include "' . $modulesLocation .
      'val_default_expansion_module.rnc"'."$end\n";
  }
  // Include interpreted expression attribute if needed
  if ($needInAtt){
    echo "#\n# INTERPRETED EXPRESSION ATTRIBUTE IS INCLUDED\n";
    echo "#\n".'include "' . $modulesLocation .
        'per_attrib_expansion_module.rnc"'."$end\n";      
  }  
  // Include non-default values of interpretation of expressions if needed
  if ($needInND){
    echo "#\n# NON-DEFAULT VALUES OF EXPRESSION INTERPRETATION INCLUDED\n";
    echo "#\n".'include "' . $modulesLocation .
        'per_non-default_expansion_module.rnc"'."$end\n";
  }
  // Include default values of interpretation of expressions if needed
  if ($needInD){
    echo "#\n# DEFAULT VALUE OF EXPRESSION INTERPRETATION INCLUDED\n";
    echo "#\n".'include "' . $modulesLocation .
      'per_default_expansion_module.rnc"'."$end\n";
  }
  //Step 4B. Initialize abstract patterns
    if ($needInit){
      echo "#\n# INITIALIZATION MODULES INCLUDED\n";
      echo "#\n".'include "' . $modulesLocation .
          'init_expansion_module.rnc"'."$end\n";
    }


  //Step 4A. Translate to requested xs:lang
  // FIXME: need to handle differently when more than one alternate available
  //        or simulataneous alternate element names allowed
  if ($blng){
    // Include long English element names
    if ($needLongNames){
      echo "#\n# LONG ENGLISH ELEMENT NAMES\n";
      echo "#\n".'include "' . $modulesLocation .
          'long_name_expansion_module.rnc"'."$end\n";
      // this second module is separated out because of a short-coming in trang
      // where element xyz{notAllowed} is not simplified to notAllowed
      // with the result that we cannot rename abstract elements if
      // we want to be able to generate XSD or monolithic content-models    
      if ($needRepo){
        echo "#\n".'include "' . $modulesLocation .
            'long_name_repo_expansion_module.rnc"'."$end\n";      
      }
      if ($needResl){
        echo "#\n".'include "' . $modulesLocation .
            'long_name_resl_expansion_module.rnc"'."$end\n";
      }
    }
  }
echo "\n#";

}
//Functions
function processGETParameter ($paramName){
  $param_base_default = "x";
  $bparam_default = decbin(hexdec('fff'));
  if(isset($_GET[$paramName])) {
    $param = $_GET[$paramName];
    //echo("#\n#  The ".$paramName." parameter has length ".strlen($param)."\n");
    if (strlen($param)>0){
      $param_base = substr($param,0,1);
    } else {
      $param_base = $param_base_default;
    }
    if (preg_match('/x|0/',$param_base)){
      //echo("#  The ".$paramName." parameter base is ".$param_base."\n");
      if (strcmp($param_base, 'x')==0){
        $xparam = substr($param,1);
        //echo("# The ".$paramName." parameter was provided in hexadecimal");
        //echo(" as ".$xparam);
        //echo(".\n");
        if (ctype_xdigit($xparam)) {
          $bparam = decbin(hexdec($xparam));
        } else {
          echo "#\n# Warning: The string $xparam does not consist of all".
               "hexadecimal digits.\n";
          echo "# Default (supremum) ".$paramName." parameter is assumed.\n";
          $bparam = $bparam_default;
        }
      } elseif (strcmp($param_base, '0')==0){
        $bparam = 0;
      }
    } else {
      echo "#\n# Warning: The ".$paramName." parameter ".$param." is not a".
           " hexidecimal or blank string.\n";
         echo "# Default (supremum) ".$paramName." parameter is assumed.\n";
        $bparam = $bparam_default;
    }
  } else {
    echo("#\n# The ".$paramName." parameter was not provided.\n"); 
    echo "# Default (supremum) ".$paramName." parameter is assumed.\n";
    $bparam = $bparam_default;
  }  
  //echo("#\n# The ".$paramName." parameter is ".$bparam." in binary.\n");
  return $bparam;
}

function extractBit ($bparam, $bitIndex) {
  if (strlen($bparam)>$bitIndex) {
    $bparamBit =  (boolean) (substr($bparam, -1-$bitIndex, 1)==1);
  } else {
    $bparamBit = false;
  }
  return $bparamBit;
}
?>