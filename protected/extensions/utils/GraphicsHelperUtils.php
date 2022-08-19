<?php

/**
 * Description of GraphicsHeleperUtils
 *
 * Here are some method to make easier the dealing with GraphicsHelper.
 *
 * @author CarlosGarcia
 */
class GraphicsHelperUtils {
    
    
    /**
     * Método para recuperar os banner
     *
     * @param number id
     *
    */
    public static function getBanner($id) {
 
        Yii::import('application.extensions.utils.BannersUtils');
        
        $select = "id, cool, altura, largura, modelo";
        $sql = "SELECT ".$select." FROM banners_data WHERE id = $id";

        try{          
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
   
            $recordset['cool2'] = BannersUtils::getBannersItems($recordset['id']);
            
            return $recordset;

        }catch(CDbException $e){
            echo "ERROR ".$e->getMessage();
        }
    }

    
    /*
     * 
     * <option <?php if($it == 0) echo 'selected' ?> value="0">Aleátório</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="1">1: Basico direita para esquerda</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="2">2: Basico Esquerda para direita</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="3">3. Basic bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="4">4. Basic top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="5">5. Horizontal Bar right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="6">6. Horizontal Bar left ro right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="7">7. Horizontal Bar right to left Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="8">8. Horizontal Bar left to right Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="9">9. Horizontal Bar Reverse right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="10">10. Horizontal Bar Reverse left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="11">11. Vertical Bar top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="12">12. Vertical Bar bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="13">13. Vertical Bar top to bottom Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="14">14. Vertical Bar bottom to top Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="15">15. Vertical Bar Reverse top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="16">16. Vertical Bar Reverse bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="17">17. Horizontal Bar Sequential right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="18">18. Horizontal Bar Sequential left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="19">19. Horizontal Bar SequentialR right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="20">20. Horizontal Bar SequentialR left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="21">21. Horizontal Bar Sequential right to left Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="22">22. Horizontal Bar Sequential left to right Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="23">23. Horizontal Bar SequentialR right to left Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="24">24. Horizontal Bar SequentialR left to right Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="25">25. Horizontal Bar Random left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="26">26. Horizontal Bar Random right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="27">27. Horizontal Bar Symmetry left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="28">28. Horizontal Bar Symmetry right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="29">29. Horizontal Bar Random left to right Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="30">30. Horizontal Bar Random right to left Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="31">31. Horizontal Bar Symmetry left to right Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="32">32. Horizontal Bar Symmetry right to left Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="33">33. Horizontal Bar BSequential right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="34">34. Horizontal Bar BSequential left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="35">35. Horizontal Bar BRandom right to Left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="36">36. Horizontal Bar BRandom left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="37">37. Horizontal Bar BSymmetry right to Left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="38">38. Horizontal Bar BSymmetry left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="39">39. Horizontal Bar BRSequential right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="40">40. Horizontal Bar BRSequential left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="41">41. Vertical Bar Sequential top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="42">42. Vertical Bar Sequential bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="43">43. Vertical Bar SequentialR top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="44">44. Vertical Bar SequentialR bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="45">45. Vertical Bar SequentialR top to bottom Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="46">46. Vertical Bar SequentialR bottom to top Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="47">47. Vertical Bar SequentialR top to bottom Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="48">48. Vertical Bar SequentialR bottom to top Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="49">49. Vertical Bar Random bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="50">50. Vertical Bar Random top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="51">51. Vertical Bar Symmetry bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="52">52. Vertical Bar Symmetry top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="53">53. Vertical Bar Random bottom to top Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="54">54. Vertical Bar Random top to bottom Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="55">55. Vertical Bar Symmetry bottom to top Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="56">56. Vertical Bar Symmetry top to bottom Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="57">57. Vertical Bar BSequential bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="58">58. Vertical Bar BSequential top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="59">59. Vertical Bar BRSequential bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="60">60. Vertical Bar BRSequential top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="61">61. Vertical Bar BRandom bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="62">62. Vertical Bar BRandom top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="63">63. Vertical Bar BSymmetry bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="64">64. Vertical Bar BSymmetry top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="65">65. Horizontal Bar Center Stretch</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="66">66. Horizontal Center Stretch</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="67">67. Vertical Bar Center Stretch</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="68">68. Vertical Center Stretch</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="69">69. Horizontal Bar Intersect</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="70">70. Horizontal Bar RIntersect</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="71">71. Horizontal Bar Intersect Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="72">72. Horizontal Bar RIntersect Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="73">73. Horizontal Bar Intersect NS</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="74">74. Horizontal Bar Intersect NS Bounc</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="75">75. Horizontal Bar BIntersect</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="76">76. Horizontal Bar BRIntersect</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="77">77. Vertical Bar Intersect</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="78">78. Vertical Bar RIntersect</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="79">79. Vertical Bar Intersect Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="80">80. Vertical Bar RIntersect Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="81">81. Vertical Bar Intersect NS</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="82">82. Vertical Bar Intersect NS Bounc</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="83">83. Vertical Bar BIntersect</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="84">84. Vertical Bar BRIntersect</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="85">85. Fade Out</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="86">86. OverLap Fade</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="87">87. Blind</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="88">88. Blind Sequential</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="89">89. Blind RSequential</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="90">90. VBlind</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="91">91. VBlind Sequential</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="92">92. VBlind RSequential</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="93">93. Blind Spread</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="94">94. VBlind Spread</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="95">95. Cut</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="96">96. Vertical Cut left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="97">97. Vertical Cut right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="98">98. Vertical RCut left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="99">99. Vertical RCut right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="100">100. Horizontal Cut left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="101">101. Horizontal Cut right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="102">102. Horizontal RCut left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="103">103. Horizontal RCut right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="104">104. Square right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="105">105. Square left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="106">106. Square R right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="107">107. Square R left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="108">108. Square right to left Back</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="109">109. Square left to right Back</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="110">110. Square R right to left Back</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="111">111. Square R left to right Back</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="112">112. Square Hide left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="113">113. Square Hide right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="114">114. Square Hide R left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="115">115. Square Hide R right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="116">116. Square Smooth Hide right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="117">117. Square Smooth Hide left ro right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="118">118. HSquare Fade</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="119">119. HSquare RFade</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="120">120. HSquare Bounce Hide top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="121">121. HSquare Bounce Hide bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="122">122. HSquare Bounce RHide top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="123">123. HSquare Bounce RHide bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="124">124. Plazma right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="125">125. Plazma left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="126">126. VS Plazma bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="127">127. VS Plazma top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="128">128. VS Plazma R bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="129">129. VS Plazma R top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="130">130. Border Hide</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="131">131. Border Serpentine Hide</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="132">132. Border R Serpentine Hide</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="133">133. HBorder Hide</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="134">134. HBorder RHide</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="135">135. Dissolve</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="136">136. HPlazma right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="137">137. HPlazma left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="138">138. VPlazma top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="139">139. VPlazma bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="140">140. Circle Spread</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="141">141. Circle RSpread</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="142">142. Circle Ward</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="143">143. Circle Rotate</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="144">144. Circle RRotate</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="145">145. Swap</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="146">146. HSwap left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="147">147. HSwap right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="148">148. HSwap left to right Back</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="149">149. HSwap right to left Back</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="150">150. VSwap top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="151">151. VSwap bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="152">152. VSwap top to bottom Back</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="153">153. VSwap bottom to top Back</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="154">154. Tile Sequence left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="155">155. Tile Sequence right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="156">156. Tile Sequence top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="157">157. Tile Sequence bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="158">158. Tile PSequence left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="159">159. Tile PSequence right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="160">160. Tile PSequence Random left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="161">161. Tile PSequence Random right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="162">162. Tile PSequence Random tl to rb</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="163">163. Tile PSequence Random tr to lb</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="164">164. Tile PSequence Random bl to rt</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="165">165. Tile PSequence Random br to lt</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="166">166. Twist Turn</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="167">167. Twist RTurn</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="168">168. HTwist Turn</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="169">169. HTwist RTurn</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="170">170. Chain</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="171">171. RChain</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="172">172. SChain</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="173">173. SRChain</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="174">174. Zigzaw</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="175">175. Zoom In</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="176">176. Zoom Out</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="177">177. HTail right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="178">178. HTail left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="179">179. HTail R right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="180">180. HTail R left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="181">181. HTail Random right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="182">182. HTail Random left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="183">183. HTail Fade</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="184">184. HTail RFade</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="185">185. VTail top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="186">186. VTail R top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="187">187. VTail bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="188">188. VTail R bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="189">189. VTail Random top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="190">190. VTail Random bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="191">191. VTail Fade</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="192">192. VTail RFade</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="193">193. Fly right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="194">194. Fly left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="195">195. Fly top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="196">196. Fly bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="197">197. Rotate Fade</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="198">198. Mirrow</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="199">199. Mirrow Push</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="200">200. VMirrow</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="201">201. VMirrow Push</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="202">202. Flip</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="203">203. Flip R</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="204">204. VFlip</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="205">205. VFlip R</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="206">206. Rotate Open</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="207">207. Rotate Open R</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="208">208. VRotate Open</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="209">209. VRotate ROpen</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="210">210. 4 Sector Sequence</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="211">211. 4 Sector Rotate</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="212">212. 4 Sector Scale</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="213">213. 4 Sector DSequence</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="214">214. 4 Sector Center Stretch</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="215">215. 4 Sector Vanish</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="216">216. 4 Sector Rotate Vanish</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="217">217. 4 Sector Scale Vanish</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="218">218. 4 Sector Fly Vanish</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="219">219. 4 Sector Center Vanish</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="220">220. Page tl</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="221">221. Page bl</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="222">222. Page tr</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="223">223. Page br</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="224">224. Page R tl</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="225">225. Page R bl</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="226">226. Page R tr</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="227">227. Page R br</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="228">228. Carousel right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="229">229. Carousel left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="230">230. Carousel bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="231">231. Carousel top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="232">232. Carousel rt to lb</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="233">233. Carousel rb to lt</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="234">234. Carousel lt to rb</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="235">235. Carousel lb to rt</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="236">236. Switch</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="237">237. Overlap left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="238">238. Overlap right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="239">239. Overlap top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="240">240. Overlap bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="241">241. Rotate Page</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="242">242. Rotate RPage</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="243">243. VRotate Page</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="244">244. VRotate RPage</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="245">245. Overlap Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="246">246. Overlap RBounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="247">247. VOverlap Bounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="248">248. VOverlap RBounce</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="249">249. CSquare Hide</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="250">250. CSquare Sequence</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="251">251. CSquare Serpentine</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="252">252. VCSquare Serpentine</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="253">253. CSquare Border Hide</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="254">254. CSquare Plus Hide</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="255">255. CSquare DHide</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="256">256. CSquare VHide</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="257">257. CSquare DMirrow Hide</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="258">258. CSquare VPoint Hide</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="259">259. FHSquare Sequence</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="260">260. FVSquare Sequence</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="261">261. FHSquare Serpentine</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="262">262. FVSquare Serpentine</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="263">263. FSquare Border</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="264">264. FSquare Plus</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="265">265. FSquare D</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="266">266. FSquare V</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="267">267. FSquare DMirrow</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="268">268. FSquare VPoint</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="269">269. VGate</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="270">270. RGate</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="271">271. HGate</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="272">272. HRGate</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="273">273. Skew 1</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="274">274. Skew 2</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="275">275. Skew 3</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="276">276. Skew 4</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="277">277. Skew 5</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="278">278. Skew 6</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="279">279. Skew 7</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="280">280. Skew 8</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="281">281. Rubber Skew</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="282">282. Square Push Random</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="283">283. Square OPush</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="284">284. HSquare Push</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="285">285. VSquare Push</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="286">286. HSquare RPush</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="287">287. VSquare RPush</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="288">288. Row Carousel right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="289">289. Row Carousel left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="290">290. Row RCarousel right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="291">291. Row RCarousel left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="292">292. Col Carousel right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="293">293. Col Carousel left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="294">294. Col RCarousel right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="295">295. Col RCarousel left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="296">296. HBar Shade</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="297">297. Shade</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="298">298. HBar Flip</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="299">299. VBar Shade</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="300">300. VBar Shade Flip</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="301">301. VBar Shade Sequence</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="302">302. Blur</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="303">303. Square Shade Flip</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="304">304. VSquare Shade Flip</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="305">305. Blinds Flip</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="306">306. Blinds Sequence Flip</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="307">307. VBlinds Flip</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="308">308. VBlinds Sequence Flip</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="309">309. VBlinds TFlip</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="310">310. VBlinds TFlip Sequence</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="311">311. HBlinds TFlip</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="312">312. HBlinds TFlip Sequence</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="313">313. Turn Page</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="314">314. Cube top to bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="315">315. Cube bottom to top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="316">316. Cube right to left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="317">317. Cube left to right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="318">318. VCube DSlice top bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="319">319. VCube DSlice bottom top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="320">320. HCube DSlice right left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="321">321. HCube DSlice left right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="322">322. VCube 4 Slice top bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="323">323. VCube 6 Slice top bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="324">324. VCube 8 Slice top bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="325">325. VCube 10 Slice top bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="326">326. VCube 4 Slice bottom top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="327">327. VCube 6 Slice bottom top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="328">328. VCube 8 Slice bottom top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="329">329. VCube 10 Slice bottom top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="330">330. VBar 4 Slice SScale bottom top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="331">331. VBar 4 Slice Scale bottom top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="332">332. VBar 6 Slice SScale bottom top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="333">333. VBar 6 Slice Scale bottom top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="334">334. VBar 8 Slice SScale bottom top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="335">335. VBar 8 Slice Scale bottom top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="336">336. VBar 4 Slice SScale top bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="337">337. VBar 4 Slice Scale top bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="338">338. VBar 6 Slice SScale top bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="339">339. VBar 6 Slice Scale top bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="340">340. VBar 8 Slice SScale top bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="341">341. VBar 8 Slice Scale top bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="342">342. VBar 4 Slice SDance bottom top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="343">343. VBar 4 Slice Dance bottom top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="344">344. VBar 6 Slice SDance bottom top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="345">345. VBar 6 Slice Dance bottom top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="346">346. VBar 8 Slice SDance bottom top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="347">347. VBar 8 Slice Dance bottom top</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="348">348. VBar 4 Slice SDance top bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="349">349. VBar 4 Slice Dance top bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="350">350. VBar 6 Slice SDance top bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="351">351. VBar 6 Slice Dance top bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="352">352. VBar 8 Slice SDance top bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="353">353. VBar 8 Slice Dance top bottom</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="354">354. HBar 4 Slice right left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="355">355. HBar 5 Slice right left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="356">356. HBar 6 Slice right left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="357">357. HBar 4 Slice left right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="358">358. HBar 5 Slice left right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="359">359. HBar 6 Slice left right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="360">360. HBar 3 Slice SScale left right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="361">361. HBar 3 Slice Scale left right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="362">362. HBar 5 Slice SScale left right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="363">363. HBar 5 Slice Scale left right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="364">364. HBar 7 Slice SScale left right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="365">365. HBar 7 Slice Scale left right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="366">366. HBar 3 Slice SScale right left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="367">367. HBar 3 Slice Scale right left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="368">368. HBar 5 Slice SScale right left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="369">369. HBar 5 Slice Scale right left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="370">370. HBar 7 Slice SScale right left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="371">371. HBar 7 Slice Scale right left</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="372">372. HBar 3 Slice SDance left right</option>
                                        <option <?php if($it == 1) echo 'selected' ?> value="373">373. HBar 3 Slice Dance left right</option>
                                        <option <?php if($it == 374) echo 'selected' ?> value="374">374. HBar 4 Slice SDance left right</option>
                                        <option <?php if($it == 375) echo 'selected' ?> value="375">375. HBar 4 Slice SDance left right</option>
                                        <option <?php if($it == 376) echo 'selected' ?> value="376">376. HBar 5 Slice SDance left right</option>
                                        <option <?php if($it == 377) echo 'selected' ?> value="377">377. HBar 5 Slice Dance left right</option>
                                        <option <?php if($it == 378) echo 'selected' ?> value="378">378. HBar 3 Slice SDance right left</option>
                                        <option <?php if($it == 379) echo 'selected' ?> value="379">379. HBar 3 Slice Dance right left</option>
                                        <option <?php if($it == 380) echo 'selected' ?> value="380">380. HBar 4 Slice SDance right left</option>
                                        <option <?php if($it == 382) echo 'selected' ?> value="381">381. HBar 4 Slice SDance right left</option>
                                        <option <?php if($it == 382) echo 'selected' ?> value="382">382. HBar 5 Slice SDance right left</option>
                                        <option <?php if($it == 383) echo 'selected' ?> value="383">383. HBar 5 Slice Dance right left</option>
                                        <option <?php if($it == 384) echo 'selected' ?> value="384">384. Cube Rotate Fly</option>
                                        <option <?php if($it == 385) echo 'selected' ?> value="385">385. Cube RRotate Fly</option>
                                        <option <?php if($it == 386) echo 'selected' ?> value="386">386. Cube HTurn 90</option>
                                        <option <?php if($it == 387) echo 'selected' ?> value="387">387. Block Rotate</option>
     * 
     */
    /**
     * Método para recuperar as fotos
     *
     * @param number id
     *
    */
    public static function getPhotos($id) {

        $select = "titulo, descricao, foto";
        $sql = "SELECT ".$select." FROM conteudo_images WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            return $recordset;

        }catch(CDbException $e) {
            echo "ERROR ".$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar as fotos
     *
     * @param number id
     *
    */
    public static function getHtmlBanners($id, $type) {
        
        Yii::import('application.extensions.utils.BannersUtils');
        
        $select = "id, cool, altura, largura, tipo";
        $sql = "SELECT ".$select." FROM banners_data WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();            
 
            if(!$recordset) return false;
            
            $recordset['cool2'] = BannersUtils::getBannersItems($recordset['id']);
            $recordset['slot_type'] = $type;
            
            return $recordset;

        }catch(CDbException $e) {
            echo "ERROR ".$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar as fotos
     *
     * @param number id
     *
    */
    public static function getCool($id) {
        
        $select = "id, cool_p, cool_m, cool_g, cool_j, tipo";
        $sql = "SELECT ".$select." FROM conteudo_cool WHERE id = $id";

        try{
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryRow();            
 
            if(!$recordset) return false;
            
            return $recordset;

        }catch(CDbException $e) {
            echo "ERROR ".$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar as fotos
     *
     * @param number id
     *
    */
    public static function getEmbededImages($id) {
        
        Yii::import('application.extensions.utils.special.ImagesUtils');

        $select = "titulo, ficha_tecnica";
        $sql = "SELECT ".$select." FROM conteudo_images WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow(); 
            
            if($recordset){
                $recordset['embeded'] = ImagesUtils::resizeIframe($recordset['ficha_tecnica'], 'small');
                $recordset['embeded_regular'] = ImagesUtils::resizeIframe($recordset['ficha_tecnica'], 'regular');
                $recordset['embeded_medium'] = ImagesUtils::resizeIframe($recordset['ficha_tecnica'], 'medium');
                $recordset['embeded_original'] = ImagesUtils::resizeIframe($recordset['ficha_tecnica'], 'original');
                $recordset['embeded_full'] = ImagesUtils::resizeIframe($recordset['ficha_tecnica'], 'full');
                $recordset['slot_type'] = 'e';
            }
            
            return $recordset;

        }catch(CDbException $e) {
            echo "ERROR ".$e->getMessage();
        }
    }
}
?>
