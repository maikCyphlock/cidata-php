# Skill Registry — cidata-php

Generated: 2026-04-25
Project: cidata-php (PHP 8.2 / Apache / MariaDB / Vanilla JS)

---

## User Skills

| Skill | Trigger | Relevant |
|-------|---------|---------|
| branch-pr | Creating a PR, opening a pull request, preparing changes for review | ✅ |
| issue-creation | Creating a GitHub issue, reporting a bug, requesting a feature | ✅ |
| judgment-day | "judgment day", "judgment-day", "adversarial review", "dual review", "doble review", "juzgar" | ✅ |
| skill-creator | Creating a new skill, adding agent instructions, documenting patterns | ✅ |
| go-testing | Writing Go tests, using teatest, adding Go test coverage | ❌ (PHP project) |

---

## Compact Rules

### branch-pr
```
- Branch naming: `<type>/<scope>-<short-description>` (e.g. feat/hero-animation)
- Commit style: conventional commits — `feat(scope): description`
- PR title: same as commit message style, under 70 chars
- PR body: ## Summary (bullets) + ## Test plan (checklist) + 🤖 attribution
- Type-to-label: feat→type:feature, fix→type:bug, docs→type:docs, refactor→type:refactor, chore→type:chore
- Always run: `gh pr create --title "..." --body "..."` then add label
- Link issue with `Closes #N` in PR body
```

### issue-creation
```
- Always create an issue BEFORE creating a branch or PR
- Issue title: imperative, under 72 chars
- Issue body: ## Context + ## Proposed Solution + ## Acceptance Criteria (checklist)
- Add appropriate labels after creation
- Reference issue in every commit: `feat(scope): description — closes #N`
```

### judgment-day
```
- Launch two independent judge sub-agents simultaneously (parallel)
- Each judge sees: same target code, same review criteria, NO prior judgements
- Synthesize findings, apply fixes, re-judge until both pass (max 2 iterations)
- Escalate to user if neither judge passes after 2 rounds
- Inject project standards (this registry's compact rules) into both judge prompts
```

---

## Project Conventions

No project-level CLAUDE.md or agents.md found at project root.
Conventions are inferred from the codebase:
- PHP includes pattern: sections/*.php included from index.php
- Vanilla JS: no bundler, plain DOM APIs + GSAP for animations
- Docker-based dev: `docker compose up` starts PHP+MariaDB+Adminer+Mailpit
- cPanel-style layout: public_html/ is web root; db.php lives outside
- Design tokens: DESIGN.md (Cyber-Fiber Kinetic theme, OKLCH colors)
- PHPMailer for email; Mailpit for local SMTP testing
