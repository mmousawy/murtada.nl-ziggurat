<?php
#zigg:title       = `Minimizing technical debt`
#zigg:page-title  = `Minimizing technical debt`
#zigg:slug        = `minimizing-technical-debt`
#zigg:type        = `markdown`
#zigg:template    = `blog-post`
#zigg:parent      = `blog`
#zigg:cover-image = `assets/images/blog/_minimizing-technical-debt{$size}.png`
#zigg:cover-image-webp = `assets/images/blog/_minimizing-technical-debt{$size}.webp`
#zigg:cover-alt   = `Isometric illustration of a monitor/computer screen being filled with paint.`
#zigg:date        = `2019-11-14`
#zigg:description = `Using SVGs on the web is a great way to have responsive images in your product. Usually SVGs are used for illustrations and icons, but what about using them for backgrounds? Let's dive in!`
?>

"Technical debt" is a metaphor introduced decades ago for project stakeholders to illustrate what we developers would call "refactoring". As such, the term might encompass everything that causes a slow down or friction in development. The overuse of this metaphor makes the term lose some of its strength.
In this post I'll be describing and discerning a concise definition of "technical debt" to reach a better understanding of this metaphor, as well as providing a possible path for solutions for this issue.

## What exactly is technical debt?

In a nutshell, technical debt is the increase of <span class="tip" title="both in terms of finances and time">costs</span> and a decrease in <span class="tip" title="the available options and agility to make technical changes ">maneuverability</span> of your organisation as a result of prior decisions that were made to save time or money when implementing new features or maintaining existing ones.<br>
It usually occurs when the project codebase becomes overly complex, and when new systems aren't integrated correctly. This is due to a variety of reasons: from hastily made decisions, lack of (technical) knowledge or using outdated versions of software, amongst many others.

Some examples would be:
<ol>
  <li>Using and old version of Linux on your server that prevents you from using new features or applying security upgrades.</li>
  <li>A vicious circle of using a CRM system that is so old and customized that it's unfeasible to upgrade it, as that would mean a complete replacement of the system.</li>
  <li>Using similar systems with overlapping functions throughout different parts of your project.</li>
</ol>

Even though the term technical debt can mean many things, it does not serve for describing bugs in the codebase. Bugs are an opaque phenomenon: they are bound to features in your software. Bugs can be tested and identified pretty easily.<br>
Technical debt is completely different in that its presence is almost intangible: it is bound to the decisions made in the architecture of your software, it is not bound to specific features. That's why the presence of technical debt is usually invisible and can unsuspectingly accumulate to cause big problems in the future.

<figure class="picture-wrapper picture-wrapper--outside">
  <picture class="lazy">
    <source data-srcset="assets/images/blog/_technical-debt-diagram-1024px.webp 1024w, assets/images/blog/_technical-debt-diagram-1920px.webp 1920w" type="image/webp">
    <source data-srcset="assets/images/blog/_technical-debt-diagram-1024px.png 1024w, assets/images/blog/_technical-debt-diagram-1920px.png 1920w" type="image/png">
    <img data-src="assets/images/blog/_technical-debt-diagram-1920px.png" data-action="zoom" alt="Diagram illustrating the visiblity and relationship of bugs vs. technical debt.">
  </picture>
  <figcaption class="picture-wrapper__caption">Diagram illustrating the visiblity and relationship of bugs vs. technical debt.</figcaption>
</figure>


## Finding a path to solutions

Reading and informing yourself about technical debt is important, but how do you take some measures to actually resolve this issue?

Actually, financial debt has a lot of overlap with technical debt. Therefore, the techniques to manage financial debt lend a great way to assess and pay off technical debt as well. We're going to apply some of these techniques to figure out a clear path to move forward.

### 1. Identify and measure your technical debt
Identifying your debt is not easy. A good moment to pinpoint a debt is when your system is growing and needs new features. Developers in your organisation will voice their concerns and describe what obstacles lie on the road for implementing a new feature. Some of these obstacles are not about the complexity of writing the actual code, nor are they about expertise levels of the developers. Instead, they are a challenge because of a prior choice in the architecture of the system. At this moment, technical debt is much easier to identify than by doing an analysis after implementation.

As for measurement of technical debt: technical debt comes in multiple forms, depending on how much impact it has on your system and how much effort you will need to put in to pay off the debt.<br>
You can simplify this process by placing your top ten ideas in a two-by-two matrix: difficulty to pay off the debt on one axis and the degree of benefits on the other. The matrix will hopefully provide a clear visual reference of which issues to prioritize.


### 2. Deciding what to do with each issue

How do you actually deal with the technical debt you identified? Each issue is unique and there are many options to take.

Perhaps the best choice is not to do anything. Debt that is assessed to have "small impact" or debt that as a "low interest rate" might be optimal to just leave it. The same goes for technical debt that has a high "prepayment penalty" of paying it off early. This is applicable to adopting or upgrading new systems. Strategically it might even be beneficial to stay one version behind and upgrading whenever the kinks have been worked out at someone else's expense.

Paying off the debt means that you will have to refactor your codebase and accept the cost hit. You can choose to do this immediately or gradually over the course of multiple sprints, improving the system in the process.

Outsourcing this process is another way to pay off your debt. It might ultimately cost more to outsource the execution of this process but by spreading out the initial cost and by bringing in a specialized party, it could be a great solution.

The rise of cloud-based computing and services could be yet another route. Leveraging cloud services can be an effective tool for reducing technical debt, both in expenses and shifting some of the development onto the cloud provider.


### 3. Creating a plan
