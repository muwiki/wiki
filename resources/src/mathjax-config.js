//<![CDATA[
MathJax.Hub.Config({
	showMathMenu: true,
	menuSettings: {
		zoom: "Click", // when to do MathZoom
		CTRL: true
	},
	messageStyle: "none",
	showProcessingMessages: false,
	extensions: [],
	displayAlign: 'left',
	displayIndent: 0.02, // percents
	tex2jax: {
		inlineMath: [['$', '$'], ["\\(", "\\)"]],
		displayMath: [['$$', '$$'], ["\\[", "\\]"]],
		processEscapes: true,
		element: "content",
		ignoreClass: "(tex2jax_ignore|mw-search-results|searchresults)", /* note: this is part of a regex, check the docs! */
		skipTags: ["script", "noscript", "style", "textarea", "code"],
		preview: 'none'
	},
	TeX: {
		equationNumbers: {autoNumber: "AMS"},
		extensions: [
			"autoload-all.js"
		],
		Macros: {
			/* Wikipedia compatibility: these macros are used on Wikipedia */
			empty: '\\emptyset',
			/* P: '\\unicode{xb6}',*/
			Alpha: '\\unicode{x391}', /* FIXME: These capital Greeks don't show up in bold in \boldsymbol ... */
			C: '\\mathbb{C}', /* the complex numbers */
			CC: '\\mathbb{C}',
			I: '\\mathbb{I}',
			N: '\\mathbb{N}', /* the natural numbers */
			NN: '\\mathbb{N}',
			Q: '\\mathbb{Q}', /* the rational numbers */
			QQ: '\\mathbb{Q}',
			R: '\\mathbb{R}', /* the real numbers */
			RR: '\\mathbb{R}',
			Z: '\\mathbb{Z}', /* the integer numbers */
			ZZ: '\\mathbb{Z}',
			H: '\\mathbb{H}', /* the quoternionic numbers */

			defn: '\\overset{\\mathrm{def}}{=}',

			/* some extre macros for ease of use; these are non-standard! */
			F: '\\mathbb{F}', /* a finite field */
			FF: '\\mathbb{F}',
			HH: '\\mathcal{H}', /* a Hilbert space */
			bszero: '\\boldsymbol{0}', /* vector of zeros */
			bsone: '\\boldsymbol{1}', /* vector of ones */
			bst: '\\boldsymbol{t}', /* a vector 't' */
			bsv: '\\boldsymbol{v}', /* a vector 'v' */
			bsw: '\\boldsymbol{w}', /* a vector 'w' */
			bsx: '\\boldsymbol{x}', /* a vector 'x' */
			bsy: '\\boldsymbol{y}', /* a vector 'y' */
			bsz: '\\boldsymbol{z}', /* a vector 'z' */
			bsDelta: '\\boldsymbol{\\Delta}', /* a vector '\Delta' */
			rd: '\\,\\mathrm{d}', /*  roman d for use in integrals: $\int f(x) \rd x$ */
			rdelta: '\\,\\delta', /* delta operator for use in sums */
			rD: '\\mathrm{D}', /* differential operator D */

			/* example from MathJax on how to define macros with parameters: */
			/* bold: ['{\\bf #1}', 1] */

			td: '{\\text{-}}',
			dd: '\\mathop{\\,\\mathrm{d}}\\nolimits',

			cl: '\\mathop{\\mathrm{cl}}\\nolimits',
			id: '\\mathop{\\mathrm{id}}\\nolimits', // identity, injective dimension
			pd: '\\mathop{\\mathrm{pd}}\\nolimits', // projective dimension
			fd: '\\mathop{\\mathrm{fd}}\\nolimits', // flat dimension
			im: '\\mathop{\\mathrm{im}}\\nolimits', // image
			Jac: '\\mathop{\\mathrm{Jac}}\\nolimits', // Jacobian
			Obj: '\\mathop{\\mathrm{ob}}\\nolimits',
			ob: '\\mathop{\\mathrm{ob}}\\nolimits',
			End: '\\mathop{\\mathrm{End}}\\nolimits',

			tr: '\\mathop{\\mathrm{tr}}\\nolimits',
			trace: '\\mathop{\\mathrm{trace}}\\nolimits',
			Tr: '\\mathop{\\mathrm{Tr}}\\nolimits',
			ind: '\\mathop{\\mathrm{ind}}\\nolimits',
			index: '\\mathop{\\mathrm{index}}\\nolimits',
			sig: '\\mathop{\\mathrm{sig}}\\nolimits',
			sign: '\\mathop{\\mathrm{sign}}\\nolimits',
			Sym: '\\mathop{\\mathrm{Sym}}\\nolimits',
			sym: '\\mathop{\\mathrm{sym}}\\nolimits',

			GL: '{\\rm GL}',
			SL: '{\\rm SL}',
			O: '{\\rm O}',
			U: '{\\rm U}',
			SO: '{\\rm SO}',
			SU: '{\\rm SU}',
			Sp: '{\\rm Sp}',
			Spin: '{\\rm Spin}',
			String: '{\\rm String}',
			PGL: '{\\rm PGL}',
			tmf: '\\mathrm{tmf}',
			op: '{\\rm op}',

			Der: '\\mathop{\\mathrm{Der}}\\nolimits',
			Diff: '\\mathop{\\mathrm{Diff}}\\nolimits',
			Homeo: '\\mathop{\\mathrm{Homeo}}\\nolimits',
			Map: '\\mathop{\\mathrm{Map}}\\nolimits',
			Funct: '\\mathop{\\mathrm{Funct}}\\nolimits',
			Cl: '\\mathop{\\mathrm{Cl}}\\nolimits',
			CCl: '\\mathop{\\C\\mathrm{l}}\\nolimits',
			Ad: '\\mathop{\\mathrm{Ad}}\\nolimits',
			ad: '\\mathop{\\mathrm{ad}}\\nolimits',
			modd: '\\mathop{\\,\\mathrm{mod}}\\nolimits',
			char: '\\mathop{\\mathrm{char}}\\nolimits',
			ch: '\\mathop{\\mathrm{ch}}\\nolimits',
			disc: '\\mathop{\\mathrm{disc}}\\nolimits',
			Gal: '\\mathop{\\mathrm{Gal}}\\nolimits',
			Aut: '\\mathop{\\mathrm{Aut}}\\nolimits',
			rank: '\\mathop{\\mathrm{rank}}\\nolimits',
			codim: '\\mathop{\\mathrm{codim}}\\nolimits',
			coker: '\\mathop{\\mathrm{coker}}\\nolimits',
			Div: '\\mathop{\\mathrm{Div}}\\nolimits',
			D: '\\mathop{\\mathrm{D}}\\nolimits', // quotient of Div by the equivalence
			cyc: '\\mathop{\\mathrm{cyc}}\\nolimits', // cycle EGA IV, 21.6.5.1
			grad: '\\mathop{\\mathrm{grad}}\\nolimits',
			div: '\\mathop{\\mathrm{div}}\\nolimits',
			dom: '\\mathop{\\mathrm{dom}}\\nolimits',
			ht: '\\mathop{\\mathrm{ht}}\\nolimits',
			Hom: '\\mathop{\\mathrm{Hom}}\\nolimits',
			coht: '\\mathop{\\mathrm{coht}}\\nolimits',
			Idinv: '\\mathop{\\mathrm{Id.inv}}\\nolimits', //invertible fractional ideal
			length: '\\mathop{\\mathrm{length}}\\nolimits',
			mult: '\\mathop{\\mathrm{mult}}\\nolimits',
			o: '\\mathop{\\mathrm{o}}\\nolimits',
			mf: '\\mathfrak',
			ms: '\\mathscr',
			mbf: '\\mathbf',
			mb: '\\mathbb',
			mcl: '\\mathcal',
			bs: '\\boldsymbol',
			ann: '\\mathop{\\mathrm{Ann}}\\nolimits',
			Ann: '\\mathop{\\mathrm{Ann}}\\nolimits',
			Ass: '\\mathop{\\mathrm{Ass}}\\nolimits',
			Pic: '\\mathop{\\mathrm{Pic}}\\nolimits', //Picard group
			Spec: '\\mathop{\\mathrm{Spec}}\\nolimits',
			Spf: '\\mathop{\\mathrm{Spf}}\\nolimits',
			maxSpec: '\\mathop{\\text{max-Spec}}\\nolimits',
			Supp: '\\mathop{\\text{Supp}}\\nolimits',
			supp: '\\mathop{\\mathrm{supp}}\\nolimits',
			depth: '\\mathop{\\mathrm{depth}}\\nolimits',
			codepth: '\\mathop{\\mathrm{codepth}}\\nolimits',
			spf: '\\mathop{\\mathrm{spf}}\\nolimits',
			ord: '\\mathop{\\mathrm{ord}}\\nolimits',
			holim: '\\mathop{\\mathrm{holim}}',

			capp: '\\mathop{\\frown}\\nolimits',
			cupp: '\\mathop{\\smile}\\nolimits',

			pt: '{\\rm pt}',
			Ext: '{\\rm Ext}',
			Tor: '{\\rm Tor}',

			Prob: '{\\rm P}', //Probability

			Var: '\\mathop{\\mathrm{Var}}\\nolimits',
			Cov: '\\mathop{\\mathrm{Cov}}\\nolimits',
			corr: '\\mathop{\\mathrm{corr}}\\nolimits',
			E: '\\mathop{\\mathrm{E}}\\nolimits',          /* Expected Value */

			st: '\\mathop{\\textrm{st}}\\nolimits',
			sgn: '\\mathop{\\textrm{sgn}}\\nolimits',
			tg: '\\mathop{\\textrm{tg}}\\nolimits',
			cotg: '\\mathop{\\textrm{cotg}}\\nolimits',
			arctg: '\\mathop{\\textrm{arctg}}\\nolimits',
			arccot: '\\mathop{\\textrm{arccot}}\\nolimits',
			arccotg: '\\mathop{\\textrm{arccotg}}\\nolimits',
			Gr: '\\mathop{\\textrm{Gr}}\\nolimits',
			Eigen: '\\mathop{\\textrm{Eigen}}\\nolimits'
		}
	}
});

//]]>
