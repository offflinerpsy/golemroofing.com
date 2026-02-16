---
applyTo: "**"
description: "OpenMemory mandatory usage in this project"
---

Always use OpenMemory for cross-session memory in this project.

Rules:
1. Query memory before complex tasks.
2. Use stable project scope id project::golemroofing.com::1429b68e.
3. Pass this exact scope id as `user_id` in every openmemory_query/openmemory_store/openmemory_list/openmemory_get.
4. Include `project_name` in metadata on store.
5. Store concise outcomes only: decision, constraint, preference, next step.
6. Never store secrets or credentials.
